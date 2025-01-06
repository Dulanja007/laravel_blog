<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WelcomeController::class,'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//post 
Route::get('/posts/{postId}/show',[PostController::class,'show'])->name('posts.show');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/posts/store',[PostController::class,'store'])->name('posts.store');
    Route::get('posts/all',[HomeController::class,'allPosts'])->name('posts.all');
    Route::get('posts/{postId}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::post('posts/{postId}/update',[PostController::class,'update'])->name('posts.update');//post update
    Route::get('posts/{postId}/delete',[PostController::class,'delete'])->name('posts.delete');//post delete
});

//Admin routes
Route::group(['middleware' => [ 'admin','auth'],'prefix'=>'admin', 'as' => 'admin.'], function() {
    Route::get('/dashboard',[DashboardController::class,'index'])->middleware('admin')->name('dashboard');
});
//Route::get('/admin/dashboard',[DashboardController::class,'index'])->middleware('admin')->name('admin.dashboard');