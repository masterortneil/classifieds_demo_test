<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RootController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\AdsController;

Route::get('/', [RootController::class, 'index'])->name("root_page");
Route::get('/post-ad', [PagesController::class, 'ad_form'])->name("get.ad.form");
Route::post('/post-ad', [AdsController::class, 'store_ad']);
Route::get('/get_categories_currencies', [CategoryController::class, 'get_categories_currencies']);
