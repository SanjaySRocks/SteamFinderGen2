<?php

use App\Http\Controllers\SteamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginSteamController;


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
    return view('welcome');
});

Route::post('/search', [SteamController::class, 'search']);

Route::get('/{id}', [SteamController::class, 'show']);


Route::get('/auth/steam', [LoginSteamController::class, 'redirectToSteam']);
Route::get('/auth/steam/logout', [LoginSteamController::class, 'LogOut']);
Route::get('/auth/steam/callback', [LoginSteamController::class, 'redirectCallback']);