<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_access_dashboard_and_users(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk();

        $this->actingAs($admin)
            ->get(route('admin.users'))
            ->assertOk();
    }

    public function test_editor_can_access_dashboard_but_not_users(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->get(route('admin.dashboard'))
            ->assertOk();

        $this->actingAs($editor)
            ->get(route('admin.users'))
            ->assertForbidden();
    }

    public function test_admin_login_redirects_to_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => 'correct-password',
        ]);

        $this->post(route('admin.login'), [
            'login' => $admin->username,
            'password' => 'correct-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_login_rejects_unauthorized_roles(): void
    {
        $user = User::factory()->create([
            'role' => 'visitor',
            'password' => 'correct-password',
        ]);

        $this->post(route('admin.login'), [
            'login' => $user->username,
            'password' => 'correct-password',
        ])
            ->assertSessionHasErrors('login')
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }

    public function test_admin_can_login_with_email(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => 'correct-password',
        ]);

        $this->post(route('admin.login'), [
            'login' => $admin->email,
            'password' => 'correct-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_logout_redirects_to_login_with_message(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'))
            ->assertSessionHas('success', 'You have been logged out.');

        $this->assertGuest();
    }

    public function test_admin_can_create_update_and_delete_a_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'New Editor',
                'username' => 'new_editor',
                'email' => 'new-editor@example.com',
                'role' => 'editor',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertRedirect(route('admin.users'));

        $user = User::query()->where('username', 'new_editor')->firstOrFail();

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'name' => 'Updated Editor',
                'username' => 'updated_editor',
                'email' => 'updated-editor@example.com',
                'role' => 'admin',
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('admin.users'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Editor',
            'username' => 'updated_editor',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->from(route('admin.users'))
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users'));

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        $this->actingAs($admin)
            ->post(route('admin.users.restore', $user->id))
            ->assertRedirect(route('admin.users'))
            ->assertSessionHas('success', 'User restored.');

        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    public function test_editor_cannot_manage_users(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->get(route('admin.users.create'))
            ->assertForbidden();
    }

    public function test_editor_can_manage_content_but_guest_cannot_delete_content(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->post(route('admin.services.store'), [
                'name' => 'Reliable hosting',
                'description' => 'Managed hosting for growing teams.',
                'features' => "Backups\nMonitoring",
                'image' => '',
                'sort_order' => 1,
                'published' => '1',
            ])
            ->assertRedirect(route('admin.services'));

        $service = Service::query()->firstOrFail();

        Auth::logout();
        $this->delete(route('admin.services.destroy', $service))
            ->assertRedirect(route('admin.login'));

        $this->assertDatabaseHas('services', ['id' => $service->id]);

        $this->actingAs($editor)
            ->delete(route('admin.services.destroy', $service))
            ->assertRedirect();

        $this->assertSoftDeleted('services', ['id' => $service->id]);

        $this->actingAs($editor)
            ->post(route('admin.services.restore', $service->id))
            ->assertRedirect()
            ->assertSessionHas('success', 'Service restored.');

        $this->assertDatabaseHas('services', ['id' => $service->id, 'deleted_at' => null]);
    }

    public function test_content_validation_rejects_invalid_sort_order(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->from(route('admin.services.create'))
            ->post(route('admin.services.store'), [
                'name' => 'Invalid service',
                'description' => 'This should not be saved.',
                'sort_order' => -1,
            ])
            ->assertRedirect(route('admin.services.create'))
            ->assertSessionHasErrors('sort_order');

        $this->assertDatabaseMissing('services', ['name' => 'Invalid service']);
    }

    public function test_admin_cannot_delete_or_change_own_account_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->put(route('admin.users.update', $admin), [
                'name' => $admin->name,
                'username' => $admin->username,
                'email' => $admin->email,
                'role' => 'editor',
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect()
            ->assertSessionHas('error', 'You cannot change your own role.');

        $this->actingAs($admin)
            ->from(route('admin.users'))
            ->delete(route('admin.users.destroy', $admin))
            ->assertRedirect()
            ->assertSessionHas('error', 'You cannot delete your own account.');

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin']);
    }

    public function test_user_forms_render_and_edit_form_contains_existing_data(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create([
            'name' => 'Existing Editor',
            'username' => 'existing_editor',
            'email' => 'existing@example.com',
            'role' => 'editor',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.users.create'))
            ->assertOk()
            ->assertSee('name="name"', false)
            ->assertSee('name="password_confirmation"', false);

        $this->actingAs($admin)
            ->get(route('admin.users.edit', $user))
            ->assertOk()
            ->assertSee('value="Existing Editor"', false)
            ->assertSee('value="existing_editor"', false)
            ->assertSee('value="existing@example.com"', false);

        $this->actingAs($admin)
            ->get(route('admin.users'))
            ->assertOk()
            ->assertSee('data-row-action-menu', false)
            ->assertSee('aria-label="Actions for Existing Editor"', false)
            ->assertSee('data-row-action-popup', false)
            ->assertSee('Delete user', false)
            ->assertSee('data-confirm-require="confirm"', false)
            ->assertSee('data-confirm-variant="danger"', false)
            ->assertSee('data-confirm-name="Existing Editor"', false)
            ->assertSee('w-14 bg-gray-50 px-2 py-3 font-semibold">Actions', false);
    }
}
