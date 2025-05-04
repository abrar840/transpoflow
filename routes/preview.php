<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/preview', function () {
    return view('preview/admin/admin-panel'); // Or use Livewire component
});


Route::get('/ticket/preview', function () {
    return view('preview/admin/ticket-management'); // Or use Livewire component
});