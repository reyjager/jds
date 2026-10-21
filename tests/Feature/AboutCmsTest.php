<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AboutCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_about_uses_settings_and_only_published_team_members(): void
    {
        Setting::create(['key' => 'about.hero_title', 'value' => 'Our Story']);
        Setting::create(['key' => 'about.stats', 'value' => json_encode([
            ['value' => '12', 'label' => 'Projects'],
        ])]);
        TeamMember::create(['name' => 'Visible Member', 'role' => 'Designer', 'sort_order' => 1, 'published' => true]);
        TeamMember::create(['name' => 'Hidden Member', 'role' => 'Developer', 'sort_order' => 2, 'published' => false]);

        $this->get('/about')
            ->assertOk()
            ->assertSee('Our Story')
            ->assertSee('Visible Member')
            ->assertDontSee('Hidden Member')
            ->assertSee('Projects');
    }

    public function test_editor_can_update_about_content(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->put(route('admin.about.update'), [
                'hero_title' => 'Updated About',
                'who_title' => 'Our People',
                'who_body' => 'Updated body',
                'mission_title' => 'Mission',
                'mission_body' => 'Updated mission',
                'vision_title' => 'Vision',
                'vision_body' => 'Updated vision',
                'stat_value' => ['10'],
                'stat_label' => ['Projects'],
            ])
            ->assertRedirect(route('admin.about.edit'));

        $this->assertDatabaseHas('settings', ['key' => 'about.hero_title', 'value' => 'Updated About']);
        $this->assertDatabaseHas('settings', ['key' => 'about.stats', 'value' => '[{"value":"10","label":"Projects"}]']);
    }

    public function test_admin_views_use_icons_confirmation_and_about_tabs(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);
        $member = TeamMember::create([
            'name' => 'Test Member',
            'role' => 'Designer',
            'sort_order' => 1,
            'published' => true,
        ]);

        $this->actingAs($editor)
            ->get(route('admin.team'))
            ->assertOk()
            ->assertSee('aria-label="Actions for '.$member->name.'"', false)
            ->assertSee('>Edit</span>', false)
            ->assertSee('>Delete</span>', false)
            ->assertSee('data-confirm-title="Delete team member?"', false)
            ->assertSee('data-confirm-require="confirm"', false)
            ->assertSee('cx="12" cy="5"', false)
            ->assertSee('cx="12" cy="19"', false)
            ->assertSee('<svg', false);

        $this->actingAs($editor)
            ->get(route('admin.about.edit'))
            ->assertOk()
            ->assertSee('role="tablist"', false)
            ->assertSee('data-tab-target="statistics"', false)
            ->assertSee('role="tabpanel"', false);
    }

    public function test_unauthorized_user_cannot_update_about(): void
    {
        $user = User::factory()->create(['role' => 'visitor']);

        $this->actingAs($user)
            ->put(route('admin.about.update'), [])
            ->assertForbidden();
    }

    public function test_team_photo_upload_is_validated_and_existing_photo_is_preserved(): void
    {
        Storage::fake('public');
        $editor = User::factory()->create(['role' => 'editor']);
        $member = TeamMember::create([
            'name' => 'Existing Member',
            'role' => 'Developer',
            'photo' => 'team/existing.jpg',
            'sort_order' => 1,
            'published' => true,
        ]);

        $this->actingAs($editor)
            ->put(route('admin.team.update', $member), [
                'name' => $member->name,
                'role' => $member->role,
                'sort_order' => 1,
                'published' => '1',
            ])
            ->assertRedirect(route('admin.team'));

        $this->assertDatabaseHas('team_members', ['id' => $member->id, 'photo' => 'team/existing.jpg']);

        $this->actingAs($editor)
            ->put(route('admin.team.update', $member), [
                'name' => $member->name,
                'role' => $member->role,
                'sort_order' => 1,
                'published' => '1',
                'photo' => UploadedFile::fake()->create('avatar.txt', 100, 'text/plain'),
            ])
            ->assertSessionHasErrors('photo');

        $this->actingAs($editor)
            ->put(route('admin.team.update', $member), [
                'name' => $member->name,
                'role' => $member->role,
                'sort_order' => 1,
                'published' => '1',
                'photo' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertRedirect(route('admin.team'));

        $member->refresh();
        $this->assertNotSame('team/existing.jpg', $member->photo);
        Storage::disk('public')->assertExists($member->photo);
    }
}
