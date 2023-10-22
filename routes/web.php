<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
});

Route::middleware('isLogin')->group(function() {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::controller(UserController::class)->prefix('/users')->group(function() {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::post('/store', 'store')->name('users.store');
        Route::get('/{id}', 'show')->name('users.detail');
        Route::post('/{id}/update', 'update')->name('users.update');
        Route::get('/delete', 'destroy')->name('users.destroy');
    });
});