<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'));
Route::get('/about', fn() => view('about'));
Route::get('/services', fn() => view('services'));
Route::get('/portfolio', fn() => view('portfolio'));
Route::get('/contact', fn() => view('contact'));
