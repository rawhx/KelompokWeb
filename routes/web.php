<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\KoleksiController;
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
    Route::put('/edit-postingan/{id}', [ImagesController::class, 'update'])->name('UpdateImage');
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

    // Edit postingan
    Route::get('/editfoto/{id}', [ImagesController::class, 'edit'])->name('editImage');


    Route::post('/profil/edit', [UserController::class, 'update'])->name('updateProfil');
    Route::delete('/profil', [UserController::class, 'deleteAkun'])->name('deleteProfil');

    Route::get('/album', function () {
        return view('pages.album.index');
    })->name('albumPage');
    Route::get('/album/add', function () {
        return view('pages.album.add');
    })->name('albumAddPage');



    Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksiPage');
    Route::get('/koleksi/add', [KoleksiController::class, 'dataFotoKoleksi'])->name('koleksiAddPage');
    Route::post('/koleksi/add', [KoleksiController::class, 'store'])->name('koleksiAdd');
    Route::get('/koleksi/{id}/edit', [KoleksiController::class, 'edit'])->name('koleksiEdit');
    Route::put('/koleksi/{id}', [KoleksiController::class, 'update'])->name('koleksiUpdate');
    Route::delete('/koleksi/delete', [KoleksiController::class, 'delete'])->name('koleksiDelete');
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


