<?php

use Illuminate\Support\Facades\Route;
 

 
 
Route::view('/', 'home')->name('home');

Route::view('/services', 'services')->name('services');


Route::view('/aboutus', 'aboutus')->name('aboutus');


Route::view('/contact', 'contact')->name('contact');

Route::view('/form', 'form')->name('form');

Route::view('/admin', 'AdminPanel')->name('admin');



Route::view('/cargo', 'manage-cargo')->name('cargo');
Route::view('/fleet', 'manage-fleet')->name('fleet');
Route::view('/ticket', 'manage-ticket')->name('ticket');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
