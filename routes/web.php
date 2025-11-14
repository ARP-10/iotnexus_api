<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect()->to(
        Filament::getPanel('admin')->getLoginUrl()
    );
});