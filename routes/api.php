<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('merchants', [MerchantController::class, 'store'])->name('merchants.store');
Route::post('records', [RecordController::class, 'store'])->name('records.store');
Route::post('records/search', [RecordController::class, 'search'])->name('records.search');
