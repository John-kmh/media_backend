<?php

use App\Http\Controllers\AdminListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');

    //admin
    Route::get('admin/edit', [ProfileController::class, 'edit'])->name('profile#edit');
    Route::post('admin/update', [ProfileController::class, 'update'])->name('profile#update');
    Route::get('changePassword', [ProfileController::class, 'changePassword'])->name('profile#changePassword');
    Route::post('updatePassword', [ProfileController::class, 'updatePassword'])->name('profile#updatePassword');

    //adminList
    Route::get('admin/list', [AdminListController::class, 'index'])->name('admin#list');
    Route::get('admin/listDelete/{id}', [AdminListController::class, 'deleteList'])->name('admin#deleteList');
    Route::post('admin/list', [AdminListController::class, 'search'])->name('admin#search');

    //category
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::post('category/create', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin#categoryDelete');
    Route::post('category', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin#editCategory');
    Route::post('category/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');

    //post
    Route::get('post', [PostController::class, 'index'])->name('post');
    Route::post('post/create', [PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('post/delete/{id}', [PostController::class, 'deletePost'])->name('admin#deletePost');
    Route::post('post', [PostController::class, 'searchpost'])->name('admin#searchpost');
    Route::get('post/edit/{id}', [PostController::class, 'editPost'])->name('admin#editPost');
    Route::post('post/update/{id}', [PostController::class, 'updatePost'])->name('admin#updatePost');

    //trend post
    Route::get('trendPost', [TrendPostController::class, 'index'])->name('trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'trendPostDetails'])->name('admin#trendPostDetails');
});
