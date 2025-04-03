<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.home.index');
    })->name('home');

    Route::get('/create', function () {
        return view('pages.create.index');
    })->name('create');

    Route::get('/profil', function () {
        return view('pages.profile.index');
    })->name('profil');

    Route::get('/profil/edit', function () {
        return view('pages.profile.edit');
    })->name('editProfil');

    Route::post('/profil/edit', [UserController::class, 'update'])->name('updateProfil');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('loginPage');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('registerPage');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


