<?php
use App\Http\Controllers\{
    ApiTravelController,
};
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

Route::get('/frontend/getData', [App\Http\Controllers\ApiTravelController::class, 'getData'])->name('APIgetData');

// Route::get('/frontend/getData', 'ApiTravelController@getData')->name('api_get_data');
