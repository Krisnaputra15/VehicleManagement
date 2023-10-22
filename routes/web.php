<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'loginView')->name('login.view');
    Route::post('/login/process', 'loginProcess')->name('login.process');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('isLogin')->group(function() {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::controller(UserController::class)->prefix('/users')->group(function() {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::post('/store', 'store')->name('users.store');
        Route::get('/{id}', 'show')->name('users.detail');
        Route::post('/{id}/update', 'update')->name('users.update');
        Route::get('/{id}/delete', 'destroy')->name('users.destroy');
    });
    Route::controller(VehicleController::class)->prefix('/vehicles')->group(function() {
        Route::get('/', 'index')->name('vehicles.index');
        Route::get('/create', 'create')->name('vehicles.create');
        Route::post('/store', 'store')->name('vehicles.store');
        Route::get('/{id}', 'show')->name('vehicles.detail');
        Route::post('/{id}/update', 'update')->name('vehicles.update');
        Route::get('/{id}/delete', 'destroy')->name('vehicles.destroy');
        // Route::get('/{id}/services', [ServiceController::class, 'index'])->name('services.index');
        Route::controller(ServiceController::class)->prefix('{id}/services')->group(function() {
            Route::get('/', 'index')->name('services.index');
            Route::get('/create', 'create')->name('services.create');
            Route::post('/store', 'store')->name('services.store');
            Route::get('/{serviceId}', 'show')->name('services.detail');
            Route::post('/{serviceId}/update', 'update')->name('services.update');
            Route::get('/{serviceId}/delete', 'destroy')->name('services.destroy');
        });
    });
});