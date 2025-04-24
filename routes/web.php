<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\Logout;

Route::post('/logout', Logout::class)->name('logout');
 
Route::view('/', 'home')->name('home');

Route::view('/services', 'services')->name('services');


Route::view('/aboutus', 'aboutus')->name('aboutus');


Route::view('/contact', 'contact')->name('contact');

Route::view('/form', 'form')->name('form');

Route::view('/admin', 'AdminPanel')->name('AdminPanel');



Route::view('/CargoManagement', 'manage-cargo')->name('CargoManagement');
Route::view('/FleetManagement', 'vehicleRegistration')->name('FleetManagement');
Route::view('/TicketManagement', 'manage-ticket')->name('TicketManagement');

Route::view('/vregister', 'vehicleRegistration')->name('vehicleRegistraion');



Route::view('/routeregister', 'admin.RouteRegister')->name('RouteRegister');

Route::view('/vs', 'admin.vehicle-schedule')->name('schedule');






Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




// Route::view('/homepage', 'home')
//     // ->middleware(['auth', 'verified'])
//     ->name('homepage');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
