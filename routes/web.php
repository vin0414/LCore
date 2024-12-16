<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;

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

Route::post('login',[CustomAuthController::class,'auth'])->name('login')->middleware('throttle:5,1');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
//hr module
Route::get('hr/overview',[HomeController::class,'overview']);

