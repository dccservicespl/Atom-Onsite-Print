<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PrinterRequestController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/printer_filter_section', [PrinterRequestController::class,'printer_filter_section'])->name('printer_filter_section');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AdminAuthController::class, 'admin_login'])->name('login');
    Route::post('/admin-login-action', [AdminAuthController::class, 'admin_login_action'])->name('admin.login.action');
});
