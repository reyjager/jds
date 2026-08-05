<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\ContactMessage;
use App\Http\Controllers\LoginController;

Route::middleware(['web'])->group(function () {
    Route::get('/', fn() => view('home'));

    Route::middleware('auth')->group(function () {
        Route::get('/home', fn() => view('home', ['users' => \App\Models\User::all()]))->name('home');
    });

    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/about', fn() => view('about'));
    Route::get('/services', fn() => view('services'));
    Route::get('/portfolio', fn() => view('portfolio'));
    Route::get('/contact', fn() => view('contact'));
    Route::get('/resume', fn() => view('resume.layout'));

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
});
