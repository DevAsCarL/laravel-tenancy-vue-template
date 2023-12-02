<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'AAA';    
});

Route::controller(RegisterController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('register', 'show')->name('register');
        Route::post('register', 'store')->name('register.store');
    });

Route::controller(LoginController::class)
    ->middleware(['guest'])
    ->group(function () {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'store')->name('login.store');
    });

Route::get('logout', LogoutController::class)
    ->middleware(['auth'])
    ->name('logout');

Route::controller(HomeController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('home');
    });

Route::controller(AccountController::class)
    ->prefix('account')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', 'edit')->name('account.edit');
        Route::patch('', 'update')->name('account.update');
    });

Route::controller(OrganisationController::class)
    ->prefix('organisation')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', 'edit')->name('organisation.edit');
        Route::patch('', 'update')->name('organisation.update');
    });
