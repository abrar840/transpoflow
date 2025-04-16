<?php

use Illuminate\Support\Facades\Route;
 
 
 
Route::view('/', 'home')->name('home');

Route::view('/services', 'services')->name('services');


Route::view('/aboutus', 'aboutus')->name('aboutus');


Route::view('/contact', 'contact')->name('contact');

Route::view('/form', 'form')->name('form');

Route::view('/admin', 'AdminPanel')->name('admin');



Route::view('/CargoManagement', 'manage-cargo')->name('CargoManagement');
Route::view('/FleetManagement', 'vehicleRegistration')->name('FleetManagement');
Route::view('/TicketManagement', 'manage-ticket')->name('TicketManagement');

Route::view('/vregister', 'vehicleRegistration')->name('vehicleRegistraion');



Route::view('/routeregister', 'admin.RouteRegister')->name('RouteRegister');







Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
