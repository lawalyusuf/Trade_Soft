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
Route::get('/banks', [BankController::class, 'index']);
Route::post('/addRecipient', [APIController::class, 'addRecipient']);
Route::post('/removeRecipient', [APIController::class, 'removeRecipient']);


