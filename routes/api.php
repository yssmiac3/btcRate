<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BTCController;
use App\Http\Controllers\UserController;

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

Route::get('/btcRate', [BTCController::class, 'getRate'])
    ->middleware('customAuthenticate')
    ->name('btcRate');
Route::post('/user/create', [UserController::class, 'create'])
    ->name('user.create');
Route::post('/user/login', [UserController::class, 'login'])
    ->name('user.login');
