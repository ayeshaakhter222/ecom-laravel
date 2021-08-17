<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// generate laravel auth routes:


        Auth::routes();


        // FrontendController routes

        Route::get('/', [FrontendController::class, 'home'])->name('laravel.frontPageRootPath');
        Route::get('about', [FrontendController::class, 'about'])->name('about');
        Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
        Route::get('service', [FrontendController::class, 'service'])->name('service');

        // HomeController routes

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // CategoryController routes

        Route::get('category', [CategoryController::class, 'category'])->name('category');
        Route::post('category/post', [CategoryController::class, 'categorypost'])->name('categorypost');
        Route::get('category/delete/{category_id}', [CategoryController::class, 'categorydelete'])->name('categorydelete');
        Route::get('category/all/delete' , [CategoryController::class, 'categoryalldelete'])->name('categoryalldelete');
        Route::get('category/edit/{category_id}', [CategoryController::class, 'categoryedit'])->name('categoryedit');
        Route::post('category/post/edit', [CategoryController::class, 'categoryeditpost'])->name('categoryeditpost');
        Route::get('category/restore/{category_id}', [CategoryController::class, 'categoryrestore'])->name('categoryrestore');
        Route::get('category/force/delete/{category_id}', [CategoryController::class, 'categoryforcedelete'])->name('categoryforcedelete');
        Route::post('category/check/delete', [CategoryController::class, 'categorycheckdelete'])->name('categorycheckdelete');

        // ProductController routes
        Route::get('product', [ProductController::class, 'product'])->name('product');
        Route::post('product/post', [ProductController::class, 'productpost'])->name('productpost');