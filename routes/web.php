<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Ajax\LocationController;
Route::get('/', function () {
    return view('welcome');
});

// backend route
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware([AuthenticateMiddleware::class]);

// USER
Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware([AuthenticateMiddleware::class]);
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware([AuthenticateMiddleware::class]);
});

// AJAX
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])
    ->name('ajax.location.index')
    ->middleware([AuthenticateMiddleware::class]);


Route::get('admin', [AuthController::class, 'index'])->name('auth.admin')->middleware([LoginMiddleware::class]);
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

