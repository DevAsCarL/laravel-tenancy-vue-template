<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Authentication\app\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return Inertia::module('Authentication::Tenant.Home.Index');
    })->name('home');
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

/*Route::controller(HomeController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return Inertia::module('Authentication::Tenant.Login.Show');
        })->name('home');
    });*/

Route::group([], function () {
    Route::resource('authentication', AuthenticationController::class)->names('authentication');
});
