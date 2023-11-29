<?php

use Illuminate\Support\Facades\Route;

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
        Route::get('/', 'index')->name('clients');
    });

Route::controller(ClientController::class)
    ->middleware(['auth'])
    ->prefix('clients')
    ->group(function () {
        Route::get('/', 'index')->name('clients');
        Route::get('/records', 'records');
        Route::get('/record/{client}', 'record');
        Route::get('/create', 'create');
        Route::get('/tables', 'tables');
        Route::get('/charts', 'charts');
        Route::post('/', 'store');
        Route::delete('/{client}', 'destroy');
        Route::post('/password/{client}', 'password');
        Route::post('/reset_password_massive', 'reset_password_massive');
        Route::post('/active', 'active');
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
