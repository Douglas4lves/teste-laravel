<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

});


Route::middleware(['auth'])->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/home', function(){
        return view('home');
    })->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});



