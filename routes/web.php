<?php

use App\Http\Controllers\Subdomain\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::domain('{blog:subdomain}.dev.aidanmurphey.com')->group(function() {
  Route::get('/', [BlogController::class, 'index'])->name('blog.index');
});

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
