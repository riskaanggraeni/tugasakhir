<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');
Route::get('provinces', [App\Http\Controllers\API\LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provincies_id}', [App\Http\Controllers\API\LocationController::class, 'regencies'])->name('api-regencies');
// Route::get('register/check', '[App\Http\Controllers\Auth\RegisterControlle::class,'check)->name('api-register-check');

Route::prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/provinces', [App\Http\Controllers\API\RajaOngkirController::class, 'provinces'])->name('provinces');
    Route::get('/regencies/{province_id}', [App\Http\Controllers\API\RajaOngkirController::class, 'regencies'])->name('regencies');
    Route::post('/cost', [App\Http\Controllers\API\RajaOngkirController::class, 'cost'])->name('cost');
});
