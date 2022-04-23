<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/user-details/create', [App\Http\Controllers\UserDetailController::class, 'create'])->name('user_details.create');
Route::post('/user-details', [App\Http\Controllers\UserDetailController::class, 'store'])->name('user_details.store');

Route::get('/requests/create', [App\Http\Controllers\RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [App\Http\Controllers\RequestController::class, 'store'])->name('requests.store');
Route::post('/requests/{id}', [App\Http\Controllers\RequestController::class, 'update_status'])->name('requests.update_status');