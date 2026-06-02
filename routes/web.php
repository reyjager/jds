<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\ContactMessage;

Route::get('/', fn() => view('home'));
Route::get('/about', fn() => view('about'));
Route::get('/services', fn() => view('services'));
Route::get('/portfolio', fn() => view('portfolio'));
Route::get('/contact', fn() => view('contact'));

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
