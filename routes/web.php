<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedircetController;
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


//  jika user belum login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [\App\Http\Controllers\Landing\IndexController::class, 'index']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin']);
});

// untuk superadmin dan agent dan vendor
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedircetController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
});

// untuk customer
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    Route::get('/customer', [\App\Http\Controllers\Customer\DashboardController::class, 'index']);
});
