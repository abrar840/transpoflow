<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\Logout;
use App\Livewire\Enduser\Home;
use App\Livewire\ManageFleet;
use App\Livewire\ManageTicket;
use App\Livewire\ManageCargo;
use App\Livewire\AdminPanel;
use App\Livewire\BusinessForm;
use App\Livewire\VehicleRegistration;
use Illuminate\Support\Str;


Route::get('/{company:name}/service/{service}', function ($company, $service) {
    $company = \App\Models\Company::where('name', $company)->firstOrFail();

    $serviceName = str_replace(' ', '', ucwords(str_replace('-', ' ', $service)));
    $serviceClass = "App\\Livewire\\Enduser\\" . $serviceName;

    if (class_exists($serviceClass)) {
        return app()->call($serviceClass . '@__invoke', ['company' => $company, 'service' => $service]);
    }

    abort(404, "Service not found.");
})->name('service-page');









 



Route::post('/logout', Logout::class)->name('logout');
 
Route::view('/', 'transpoflow/home')->name('home');

Route::view('/t', 'test')->name('home');

Route::view('/services', 'transpoflow/services')->name('services');


Route::view('/aboutus', 'transpoflow/aboutus')->name('aboutus');


Route::view('/contact', 'transpoflow/contact')->name('contact');

Route::get('/form', BusinessForm::class)->name('form');

Route::get('/admin', AdminPanel::class)->name('AdminPanel');
Route::get('/CargoManagement', ManageCargo::class)->name('CargoManagement');
 
Route::get('/TicketManagement', ManageTicket::class)->name('TicketManagement');

Route::get('/FleetManagement', VehicleRegistration::class)->name('vehicleRegistraion');



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
Route::get('/{company:name}', Home::class)->name('user-Home');