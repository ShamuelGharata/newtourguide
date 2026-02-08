<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [PlaceController::class, 'index'])->name('home');
Route::get('/place/{id}', [PlaceController::class, 'show'])->name('place.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/place/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/place/{id}/favorite', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
});