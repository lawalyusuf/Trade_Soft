<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('user.login');
});

// Auth::routes();


Route::group(['prefix' => 'guest'], function() {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('user.login');
    Route::post('/auth/login', [AuthController::class, 'postLogin'])->name('post.login');
    Route::get('/auth/create', [AuthController::class, 'register'])->name('user.register');
    Route::post('/auth/create', [AuthController::class, 'postRegister'])->name('post.register');
    Route::get('/auth/continue', [AuthController::class, 'continue'])->name('continue.register');
    Route::post('/auth/continue', [AuthController::class, 'postContinue'])->name('post.continue');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('recipient', RecipientController::class);
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('user.logout');


});
