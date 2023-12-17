<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', ['App\Http\Controllers\LoginRegisterController', 'register']);
Route::post('/login', ['App\Http\Controllers\LoginRegisterController', 'login']);
Route::get('/userdetails', ['App\Http\Controllers\LoginRegisterController', 'getUserDetails']);
Route::post('/task/add', ['App\Http\Controllers\ListController', 'store']);
