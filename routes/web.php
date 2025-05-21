<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('pages.home.index');
    })->name('home');

    // upload foto
    Route::get('/create', function () {
        return view('pages.create.index');
    })->name('create');
    Route::post('/create', [ImagesController::class, 'store'])->name('storeImage');
    Route::get('/create/{id}', [ImagesController::class, 'show'])->name('ShowImage');
    Route::put('/create/{id}', [ImagesController::class, 'update'])->name('UpdateImage');
    Route::delete('/create/{id}', [ImagesController::class, 'destroy'])->name('DestroyImage');
    // end

    Route::get('/profil', function () {
        return view('pages.profile.index');
    })->name('profilPage');
    
    Route::get('/like', function () {
        return view('pages.like.index');
    })->name('likePage');

    // Liked Controller
    Route::post('/like/{imageId}', [LikeController::class, 'toggle'])->name('toggleLike');
    
    Route::post('/profil/edit', [UserController::class, 'update'])->name('updateProfil');
    Route::delete('/profil', [UserController::class, 'deleteAkun'])->name('deleteProfil');
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


