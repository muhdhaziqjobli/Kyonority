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

Route::get('/bank-accounts', [App\Http\Controllers\BankAccountController::class, 'index'])->name('bank_accounts.index');
Route::get('/bank-accounts/create', [App\Http\Controllers\BankAccountController::class, 'create'])->name('bank_accounts.create');
Route::post('/bank-accounts', [App\Http\Controllers\BankAccountController::class, 'store'])->name('bank_accounts.store');
Route::delete('/bank-accounts/{id}', [App\Http\Controllers\BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');