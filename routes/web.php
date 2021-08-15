<?php

use App\Http\Controllers\Subdomain\PostController;
use App\Http\Controllers\Subdomain\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::domain('{blog:subdomain}.dev.aidanmurphey.com')->group(function() {
  Route::get('/', [BlogController::class, 'index'])->name('blog.index');

  Route::middleware(['auth', 'blog_can_manage'])->group(function() {
    Route::get('/manage', [BlogController::class, 'manage'])->name('blog.manage');

    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/{post}/edit', [PostController::class, 'update'])->name('post.update');
  });

  Route::get('/post/{post}/history', [PostController::class, 'getVersionHistory'])->name('post.versionHistory');
  Route::get('/post/{post}/{version?}', [PostController::class, 'show'])->name('post.show');
  Route::get('/post/{post}/content/{version?}', [PostController::class, 'getContent'])->name('post.getContent');
});

Route::domain('dev.aidanmurphey.com')->group(function() {
  Route::prefix('/auth')->group(function() {
    Route::view('/login', 'pages.auth.login')->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/out/{provider}', [AuthController::class, 'providerOut'])->name('auth.provider.out');
    Route::get('/callback/{provider}', [AuthController::class, 'providerCallback'])->name('auth.provider.callback');
  });

  Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create_blog', [ProfileController::class, 'createBlog'])->name('profile.create_blog');
    Route::post('/profile/create_blog', [ProfileController::class, 'storeBlog'])->name('profile.store_blog');
  });

  Route::view('/', 'pages.index')->name('page.index');
});
