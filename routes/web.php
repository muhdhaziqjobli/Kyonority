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

Route::get('/test', function () {
    return view('test');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/user-details/create', [App\Http\Controllers\UserDetailController::class, 'create'])->name('user_details.create');
Route::post('/user-details', [App\Http\Controllers\UserDetailController::class, 'store'])->name('user_details.store');

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{id}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}/download', [App\Http\Controllers\ProfileController::class, 'download'])->name('profile.download');
Route::get('/profile/{id}/delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');
Route::put('/profile/{id}/change_image', [App\Http\Controllers\ProfileController::class, 'change_image'])->name('profile.change_image');

Route::get('/requests/create', [App\Http\Controllers\RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [App\Http\Controllers\RequestController::class, 'store'])->name('requests.store');
Route::get('/requests/edit/{id}', [App\Http\Controllers\RequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{id}', [App\Http\Controllers\RequestController::class, 'update'])->name('requests.update');
Route::post('/requests/{id}/update-status', [App\Http\Controllers\RequestController::class, 'update_status'])->name('requests.update_status');
Route::delete('/requests/{id}', [App\Http\Controllers\RequestController::class, 'destroy'])->name('requests.destroy');

Route::get('/bank-accounts', [App\Http\Controllers\BankAccountController::class, 'index'])->name('bank_accounts.index');
Route::get('/bank-accounts/create', [App\Http\Controllers\BankAccountController::class, 'create'])->name('bank_accounts.create');
Route::post('/bank-accounts', [App\Http\Controllers\BankAccountController::class, 'store'])->name('bank_accounts.store');
Route::delete('/bank-accounts/{id}', [App\Http\Controllers\BankAccountController::class, 'destroy'])->name('bank_accounts.destroy');

Route::get('/location', [App\Http\Controllers\LocationController::class, 'create'])->name('location.create');
Route::post('/location', [App\Http\Controllers\LocationController::class, 'store'])->name('location.store');

Route::get('/users', [App\Http\Controllers\AdminController::class, 'user_index'])->name('admin.user_list');
Route::get('/unverified_users', [App\Http\Controllers\AdminController::class, 'unverified_users'])->name('admin.unverified_users');
Route::post('/unverified_users/{id}', [App\Http\Controllers\AdminController::class, 'verify'])->name('admin.verify');
Route::get('/report', [App\Http\Controllers\AdminController::class, 'report'])->name('admin.report');
Route::post('/report', [App\Http\Controllers\AdminController::class, 'save_report'])->name('admin.save_report');
Route::get('/report-list', [App\Http\Controllers\AdminController::class, 'report_list'])->name('admin.report_list');

Route::get('/donators/register', [App\Http\Controllers\DonatorController::class, 'register'])->name('donators.register');
Route::post('/donators/register', [App\Http\Controllers\DonatorController::class, 'register_donator'])->name('donators.register_donator');
Route::get('/donators/login', [App\Http\Controllers\DonatorController::class, 'login'])->name('donators.login');
Route::post('/donators/authenticate', [App\Http\Controllers\DonatorController::class, 'authenticate'])->name('donators.authenticate');
Route::post('/donators/logout', [App\Http\Controllers\DonatorController::class, 'logout'])->name('donators.logout');
Route::get('/donators/index', [App\Http\Controllers\DonatorController::class, 'index'])->name('donators.index');
Route::get('/donators/get-bank', [App\Http\Controllers\DonatorController::class, 'get_bank'])->name('donators.get_bank');
Route::post('/donators/donate/{donator_id}/{request_id}', [App\Http\Controllers\DonatorController::class, 'donate'])->name('donators.donate');
Route::post('/donators/index/search', [App\Http\Controllers\DonatorController::class, 'search'])->name('donators.search');
Route::post('/donators/index/filter', [App\Http\Controllers\DonatorController::class, 'filter'])->name('donators.filter');
Route::post('/donators/index/sort', [App\Http\Controllers\DonatorController::class, 'sort'])->name('donators.sort');