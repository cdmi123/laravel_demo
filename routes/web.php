<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\feedController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\followController;

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

Route::any('/',[loginController::class,'login']);
Route::any('/sign-up',[loginController::class,'register']);
Route::any('/dashbord',[feedController::class,'feed']);
Route::any('/send_req',[followController::class,'accept_req']);
Route::any('/unfollow_req',[followController::class,'unfollow_req']);
Route::any('/chat',[followController::class,'chat']);

