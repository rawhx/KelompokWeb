<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/', function () {
    //     return view('pages.home.index');
    // })->name('home');
    
    Route::get('/', [ImagesController::class, 'showHome'])->name('home');
    
    // upload foto
    Route::get('/add-postingan', function () {
        return view('pages.create.index');
    })->name('createPage');
    Route::post('/create', [ImagesController::class, 'store'])->name('storeImage');
    Route::get('/create/{id}', [ImagesController::class, 'show'])->name('ShowImage');
    Route::put('/create/{id}', [ImagesController::class, 'update'])->name('UpdateImage');
    Route::delete('/create/{id}', [ImagesController::class, 'destroy'])->name('DestroyImage');
    // end

    Route::get('/profil', function () {
        return view('pages.profile.index');
    })->name('profilPage');
    
    // Like 
    Route::post('/like/{imageId}', [LikeController::class, 'toggle'])->name('toggleLike');
    Route::get('/like', [LikeController::class, 'index'])->name('likePage');

    // Comment
    Route::post('/comments/store/{image}', [CommentController::class, 'store'])->name('storeComment');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('destroyComment');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('updateComment');

    // Detail post
    Route::get('/post/{id}', [ImagesController::class, 'showPost'])->name('detailPost');
    
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


