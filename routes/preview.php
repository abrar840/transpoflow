<?php

use Illuminate\Support\Facades\Route;


Route::get('/demo/admin', function () {
    return view('preview.admin.admin');
})->name('demo.admin');



Route::get('/demo/ticket', function () {
    return view('preview.admin.ticket-management');
})->name('demo.ticket');




Route::get('/demo/fleet', function () {
    return view('preview.admin.fleet-management');
})->name('demo.fleet');



Route::get('/demo/cargo', function () {
    return view('preview.admin.cargo-management');
})->name('demo.cargo');