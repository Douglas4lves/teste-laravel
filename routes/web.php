<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

});


Route::middleware(['auth'])->group(function() {
    Route::get('/home', function(){
        return view('home');
    })->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    // Usuários
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


});
