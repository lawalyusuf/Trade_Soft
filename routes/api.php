<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/to', [CountryController::class, 'index']);
Route::get('/countries/from', [CountryController::class, 'from']);
Route::get('/countries/from/init', [CountryController::class, 'toInit']);
Route::get('/countries/to/init', [CountryController::class, 'fromInit']);
Route::get('/banks', [BankController::class, 'index']);
Route::post('/addTransaction', [APIController::class, 'addTransaction']);
Route::post('/addRecipient', [APIController::class, 'addRecipient']);
Route::post('/removeRecipient', [APIController::class, 'removeRecipient']);
Route::get('/rate', [APIController::class, 'rate']);
Route::get('/countries/get/code', [CountryController::class, 'getCountry']);


