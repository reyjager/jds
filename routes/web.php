<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\ContactMessage;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\AboutController;
use App\Models\Service;
use App\Models\PortfolioProject;
use App\Models\TeamMember;

Route::get('/', fn() => view('home'));

Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');
Route::post('/login', fn () => redirect()->route('admin.login'));

Route::middleware('auth')->group(function () {
    Route::get('/home', fn () => view('home'))->name('home');
});
Route::get('/about', [AboutController::class, 'show']);
Route::get('/services', fn() => view('services', ['services' => Service::where('published', true)->orderBy('sort_order')->get()]));
Route::get('/portfolio', fn() => view('portfolio', ['projects' => PortfolioProject::where('published', true)->orderBy('sort_order')->get()]));
Route::get('/contact', fn() => view('contact'));
Route::get('/resume', fn() => view('resume.layout'));
Route::get('/nlfbcAnniversary', fn() => view('nlfbc'));

Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])
            ->middleware('throttle:login');
        Route::get('/forgot-password', [PasswordResetController::class, 'request'])
            ->name('password.request');
        Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
            ->middleware('throttle:password.email')
            ->name('password.email');
        Route::middleware(['auth', 'role:admin,editor'])->group(function () {
            Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
            Route::get('/', fn () => redirect()->route('admin.dashboard'));
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/users', [AuthController::class, 'users'])->name('users');
            Route::get('/users/create', [AuthController::class, 'createUser'])->name('users.create');
            Route::post('/users', [AuthController::class, 'storeUser'])->name('users.store');
            Route::get('/users/{user}/edit', [AuthController::class, 'editUser'])->name('users.edit');
            Route::put('/users/{user}', [AuthController::class, 'updateUser'])->name('users.update');
            Route::delete('/users/{user}', [AuthController::class, 'destroyUser'])->name('users.destroy');
            Route::post('/users/{user}/restore', [AuthController::class, 'restoreUser'])->name('users.restore');
        });

        Route::middleware(['auth', 'role:admin,editor'])->group(function () {
            Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
            Route::put('/about', [AboutController::class, 'update'])->name('about.update');
            Route::get('/services', [ContentController::class, 'services'])->name('services');
            Route::get('/services/create', [ContentController::class, 'createService'])->name('services.create');
            Route::post('/services', [ContentController::class, 'storeService'])->name('services.store');
            Route::get('/services/{service}/edit', [ContentController::class, 'editService'])->name('services.edit');
            Route::put('/services/{service}', [ContentController::class, 'updateService'])->name('services.update');
            Route::delete('/services/{service}', [ContentController::class, 'destroyService'])->name('services.destroy');
            Route::post('/services/{service}/restore', [ContentController::class, 'restoreService'])->name('services.restore');
            Route::get('/portfolio', [ContentController::class, 'portfolio'])->name('portfolio');
            Route::get('/portfolio/create', [ContentController::class, 'createPortfolio'])->name('portfolio.create');
            Route::post('/portfolio', [ContentController::class, 'storePortfolio'])->name('portfolio.store');
            Route::get('/portfolio/{portfolioProject}/edit', [ContentController::class, 'editPortfolio'])->name('portfolio.edit');
            Route::put('/portfolio/{portfolioProject}', [ContentController::class, 'updatePortfolio'])->name('portfolio.update');
            Route::delete('/portfolio/{portfolioProject}', [ContentController::class, 'destroyPortfolio'])->name('portfolio.destroy');
            Route::post('/portfolio/{portfolioProject}/restore', [ContentController::class, 'restorePortfolio'])->name('portfolio.restore');
            Route::get('/team', [ContentController::class, 'team'])->name('team');
            Route::get('/team/create', [ContentController::class, 'createTeam'])->name('team.create');
            Route::post('/team', [ContentController::class, 'storeTeam'])->name('team.store');
            Route::get('/team/{teamMember}/edit', [ContentController::class, 'editTeam'])->name('team.edit');
            Route::put('/team/{teamMember}', [ContentController::class, 'updateTeam'])->name('team.update');
            Route::delete('/team/{teamMember}', [ContentController::class, 'destroyTeam'])->name('team.destroy');
            Route::post('/team/{teamMember}/restore', [ContentController::class, 'restoreTeam'])->name('team.restore');
        });
});

Route::post('/contact', function (Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('reyjag@jaguines.com')->send(new ContactMessage(
            name: $request->name,
            email: $request->email,
            body: $request->message,
        ));

        return back()->with('success', 'Message sent successfully!');
});

Route::get('/admin/reset-password/{token}', [PasswordResetController::class, 'showReset'])
    ->name('password.reset');
Route::post('/admin/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');
