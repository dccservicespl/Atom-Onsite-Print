<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\ApiReadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('api/store_label_print',[ApiController::class, 'store_label_print']);
Route::post('api/final_store_label_print',[ApiController::class, 'final_store_label_print']);
