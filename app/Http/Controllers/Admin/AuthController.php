<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthController extends Controller
{
    private const ROLES = ['admin', 'editor'];

    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()
            ->where('username', $credentials['login'])
            ->orWhere('email', $credentials['login'])
            ->first();

        $request->session()->regenerate();

        if ($user === null || ! Auth::attempt([
            'username' => $user->username,
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Invalid username or password.'])
                ->onlyInput('login');
        }

        if (! $request->user()->hasRole('admin', 'editor')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->withErrors(['login' => 'This account is not authorized to access the CMS.'])
                ->onlyInput('login');
        }

        $request->session()->save();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome back, '.$request->user()->name.'.');
    }

    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    public function users(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->orderBy('name')->get(),
            'trashedUsers' => User::onlyTrashed()->orderBy('name')->get(),
        ]);
    }

    public function createUser(): View
    {
        return view('admin.users.create', [
            'user' => new User(['role' => 'editor']),
            'roles' => self::ROLES,
        ]);
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(self::ROLES)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'User created.');
    }

    public function editUser(Request $request, User $user): View
    {
        $this->authorizeAdmin($request);

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => self::ROLES,
        ]);
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'role' => ['required', Rule::in(self::ROLES)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($user->is(auth()->user()) && $data['role'] !== $user->role) {
            return back()->withInput()->with('error', 'You cannot change your own role.');
        }

        if ($data['password'] === null || $data['password'] === '') {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User updated.');
    }

    public function destroyUser(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin($request);

        if ($user->is(auth()->user())) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User soft-deleted.');
    }

    public function restoreUser(Request $request, int $user): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $deletedUser = User::onlyTrashed()->findOrFail($user);
        $deletedUser->restore();

        return back()->with('success', 'User restored.');
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->isAdmin(), 403);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out.');
    }
}
