<?php

use App\Livewire\Admin\AdminPanelPreview;

use App\Livewire\Admin\Cargo\CargoDashboard;
use App\Livewire\Admin\Cargo\RouteManager;

use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\Logout;
use App\Livewire\Enduser\Home;

use App\Livewire\ManageTicket;
use App\Livewire\ManageCargo;
use App\Livewire\AdminPanel;

use App\Livewire\BusinessForm;
use App\Livewire\VehicleRegistration;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;
use App\Models\Company;
use App\Livewire\ThemePreviewer;
use App\Livewire\CustomerSupport;

 

use App\Http\Controllers\Auth\VerifyEmailController;


Route::get('/cargo', RouteManager::class);


Route::get('/preview', AdminPanelPreview::class)->name('admin-panel-preview');

Route::get('/p', ThemePreviewer::class)->name('theme-preview');
 

Route::get('/CustomerSupport', CustomerSupport::class);



Route::get('/home-preview', function () {
    $theme = request()->get('theme', 'theme1');
    return view('preview.end-user.homepage', ['theme' => $theme]);
})->name('home.preview');


Route::get('/cargo-preview', function () {
    $theme = request()->get('theme', 'theme1');
    return view('preview.end-user.cargo', ['theme' => $theme]);
})->name('cargobooking.preview');




Route::get('/ticket-preview', function () {
    $theme = request()->get('theme', 'theme1');
    return view('preview.end-user.ticketbooking', ['theme' => $theme]);
})->name('ticketbooking.preview');



Route::get('/contact-preview', function () {
    $theme = request()->get('theme', 'theme1');
    return view('preview.end-user.contact', ['theme' => $theme]);
})->name('contactus.preview');




Route::get('/about-preview', function () {
    $theme = request()->get('theme', 'theme1');
    return view('preview.end-user.aboutus', ['theme' => $theme]);
})->name('aboutus.preview');


 




Route::get('/{company:name}/service/{service}', function ($company, $service) {
    $company = Company::where('name', $company)->firstOrFail();
      
    $serviceName = str_replace('Management','Booking',str_replace(' ', '', ucwords(str_replace('-', ' ', $service))));
    //   dd($serviceName);
    $serviceClass = "App\\Livewire\\Enduser\\" . $serviceName;
   
    if (class_exists($serviceClass)) {
        return app()->call($serviceClass . '@__invoke', ['company' => $company, 'service' => $service]);
    }

    abort(404, "Service not found.");
})->name('service-page');







Route::get('/form', BusinessForm::class)->name('form');


Route::get('/form', BusinessForm::class)->name('companyform');

 



Route::post('/logout', Logout::class)->name('logout');
 
Route::view('/', 'transpoflow/home')->name('home');



Route::view('/services', 'transpoflow/services')->name('services');


Route::view('/aboutus', 'transpoflow/aboutus')->name('aboutus');


Route::view('/contact', 'transpoflow/contact')->name('contact');
Route::view('/test', 'test')->name('contact');
// Route::view('/form', 'form')->name('form');

Route::get('/admin', AdminPanel::class)->name('AdminPanel');

Route::view('/CargoManagement', 'admin.cargo.dashboardCall')->name('CargoManagement');
 
Route::get('/TicketManagement', ManageTicket::class)->name('TicketManagement');

// Route::get('/FleetManagement', VehicleRegistration::class)->name('vehicleRegistraion');


Route::view('/FleetManagement', 'fleetmanagement')->name('vehicleRegistraion');


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








// Route::get('/{company:name}', Home::class)->name('user-Home');






// Route::get('/{company:name}/register', function (Company $company) {
//     return Volt::mount('pages.auth.end-user-register', ['company' => $company]);
// })->name('company.register');
 


// Route::middleware('guest')->group(function () {
//     Volt::route('/{company:name}/register', 'pages.auth.end-user')
//         ->name('end-user-register');
// });
        

Route::middleware('guest:end_user')->group(function () {});
    


Volt::route('/{company:name}/login', 'pages.auth.end-user-login')->name('end-user-login');
          
    Volt::route('/{company:name}/register', 'pages.auth.end-user')
        ->name('end-user-register');





// End user dashboard (end_user guard)
Route::middleware(['check.company.admin'])->group(function () {
    require __DIR__.'/auth.php';
    Route::get('/{company:name}', Home::class)->name('user-home');
});




//     Volt::route('login', 'pages.auth.login')
//         ->name('login');

//     Volt::route('forgot-password', 'pages.auth.forgot-password')
//         ->name('password.request');

//     Volt::route('reset-password/{token}', 'pages.auth.reset-password')
//         ->name('password.reset');
// });



// Route::middleware('auth')->group(function () {
//     Volt::route('verify-email', 'pages.auth.verify-email')
//         ->name('verification.notice');

//     Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//         ->middleware(['signed', 'throttle:6,1'])
//         ->name('verification.verify');

//     Volt::route('confirm-password', 'pages.auth.confirm-password')
//         ->name('password.confirm');
// });



 
use App\Livewire\Actions\Ulogout;
Route::post('/Ulogout', Ulogout::class)->name('Ulogout');





// Route::get('/admin/demo', function () {
//     return view('admin.admin-panel-preview'); // A stripped-down version of the admin panel
// })->name('admin.demo.iframe');

 


require __DIR__.'/preview.php';