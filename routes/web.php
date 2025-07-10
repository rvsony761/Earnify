<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckAuthenticated;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WithdrawalController;
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('user.register');
    Route::post('/register_store', 'register')->name('user.register_store');
    Route::get('/login', 'showlogin')->name('user.login');
    Route::post('/login', 'login')->name('user.logincheck');
    Route::post('/logout','logout')->name('user.logout');
    Route::post('/check-referral','checkReferral')->name('check.referral');

    // new investment
    Route::get('/investment', 'showinvestment')->name('user.investment')->middleware(CheckAuthenticated::class);
});

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware([CheckAuthenticated::class,AdminMiddleware::class]);
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard')->middleware(CheckAuthenticated::class);

Route::post('/investment', [InvestmentController::class, 'store'])->name('user.investment.store')->middleware(CheckAuthenticated::class);
//Route::get('/investment_show', [InvestmentController::class, 'showinvestment'])->name('user.investment.show')->middleware(CheckAuthenticated::class);
Route::get('/contact', [ContactController::class,'showcontact'])->name('user.contact')->middleware(CheckAuthenticated::class);
Route::post('/contact_us',[ContactController::class,'sendmail'])->name('contact.sendmail');

Route::get('/withdrawal_page',[WithdrawalController::class,'index'])->name('user.withdrawal')->middleware(CheckAuthenticated::class);
Route::post('/withdrawal',[WithdrawalController::class,'store'])->name('withdrawal.store')->middleware(CheckAuthenticated::class);

Route::get('/admin/dashboard/{id}/approve', [AdminController::class, 'approve'])->name('withdrawal.approve');
Route::get('/admin/dashboard/{id}/reject', [AdminController::class, 'reject'])->name('withdrawal.reject');
