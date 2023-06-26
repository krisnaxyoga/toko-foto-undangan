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
    Route::get('/detail', [\App\Http\Controllers\Landing\IndexController::class, 'detail']);
    Route::get('/list-package', [\App\Http\Controllers\Landing\IndexController::class, 'list_package'])->name('list_package');
    Route::get('/list-theme', [\App\Http\Controllers\Landing\IndexController::class, 'list_theme'])->name('list_theme');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'save_register']);
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
    Route::resource('/category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/packages', \App\Http\Controllers\Admin\PackagesController::class);
    Route::resource('/themes', \App\Http\Controllers\Admin\ThemesController::class);
    Route::resource('/customers', \App\Http\Controllers\Admin\CustomersController::class);
    Route::resource('/users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('/transaksis', \App\Http\Controllers\Admin\TransaksisController::class);
});

// untuk customer
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    Route::get('/home', [\App\Http\Controllers\Landing\IndexController::class, 'index']);
    Route::get('/customer', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/order/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'index'])->name('customer.order');
    Route::get('/customer/orderundangan/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'undangan'])->name('customer.orderundangan');

    Route::get('/customer/bayar/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'ipaymu'])->name('customer.bayar');
    Route::get('/customer/paymentcuscess', [\App\Http\Controllers\Customer\OrderController::class, 'paymentsuccess'])->name('payment.success');
    Route::get('/customer/paymentnotify', [\App\Http\Controllers\Customer\OrderController::class, 'notify'])->name('payment.notify');
    Route::get('/customer/transaksi', [\App\Http\Controllers\Customer\OrderController::class, 'transaksi'])->name('payment.transaksi');

    Route::get('/customer/bayarundangan', [\App\Http\Controllers\Customer\OrderController::class, 'ipaymuundangan'])->name('customer.bayarundangan');

    Route::get('/customer/profile/{id}', [\App\Http\Controllers\Customer\DashboardController::class, 'edit_profile'])->name('customer.profile');
    Route::put('/customer/update-profile/{id}', [\App\Http\Controllers\Customer\DashboardController::class, 'update_profile'])->name('customer.update');
});
