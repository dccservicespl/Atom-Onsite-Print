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

    Route::get('/store_number_label', [PrinterRequestController::class,'store_number_label'])->name('store_number_label');
    Route::get('/final_store_label', [PrinterRequestController::class,'final_store_label'])->name('final_store_label');
    Route::get('/printer_queue_api_check', [PrinterRequestController::class,'printer_queue_api_check'])->name('printer_queue_api_check');
    Route::get('/admin/show_printer_response_msg/{id}', [PrinterRequestController::class, 'show_printer_response_msg'])->name('show_printer_response_msg');
    Route::get('/delete_printer_queues', [PrinterRequestController::class,'delete_printer_queues'])->name('delete_printer_queues');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AdminAuthController::class, 'admin_login'])->name('login');
    Route::post('/admin-login-action', [AdminAuthController::class, 'admin_login_action'])->name('admin.login.action');
});
