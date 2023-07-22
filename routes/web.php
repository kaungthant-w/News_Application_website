<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewspostController;
use App\Http\Controllers\Admin\photoGalleryController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\User\UserController;

require __DIR__.'/auth.php';

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/', function () {
    // return view('welcome');
    return view('frontend/frontend');
});

Route::middleware(['auth', 'role:admin'])->group(function() {

    // permission user or admin
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin#dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin#logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin#profile');

    // categories
    Route::get('allcategories', [CategoryController::class, 'index'])->name('all#categories');
    Route::post('store/categories', [CategoryController::class, 'storeCategory'])->name("store#category");
    Route::post('delete/category/{id}', [CategoryController::class, 'destroy'])->name("delete#category");
    // Route::get('/category/{id}', [CategoryController::class, 'getCategory']);
    Route::post('update/category/{id}', [CategoryController::class, 'updateCategory'])->name("update#category");

    // subcategories
    Route::get('subcategory/list', [CategoryController::class, 'subcategoryList'])->name("subcategory#list");
    Route::post('store/subcategory', [CategoryController::class, 'storeSubcategory'])->name("store#subcategory");
    Route::post('update/subcategory/{id}', [CategoryController::class, 'updateSubcategory'])->name("update#subcategory");

    Route::post('delete/subcategory/{id}', [CategoryController::class, 'destroySubcategory'])->name("delete#subcategory");
    Route::get('/subcategory/ajax/{category_id}',[CategoryController::class], 'GetSubCategory');

    //active or inactive
    Route::get('admin/active/{id}', [AdminController::class, 'adminActive'])->name('admin#active');
    Route::get('admin/inactive/{id}', [AdminController::class, 'adminInactive'])->name('admin#inactive');

    //news post
    Route::get('newspost/list', [NewspostController::class, 'newspostList'])->name("newspost#list");
    Route::get('newspost/add', [NewspostController::class, 'newspostAdd'])->name("newspost#add");
    Route::post('newspost/store', [NewspostController::class, 'newspostStore'])->name("admin#news#store");
    // Route::post('newspost/delete', [NewspostController::class, 'newspostDelete'])->name("newspost#delete");
    Route::get('newspost/edit/{id}', [NewspostController::class, 'newspostEdit'])->name('newspost#edit');
    Route::post('newspost/update', [NewspostController::class, 'newspostUpdate'])->name('newspost#update');
    Route::get('newspost/delete/{id}', [NewspostController::class, 'newspostDelete'])->name('newspost#delete');
    Route::get('newspost/inactive/{id}', [NewspostController::class, 'newspostInactive'])->name('newspost#inactive');
    Route::get('newspost/active/{id}', [NewspostController::class, 'newspostActive'])->name('newspost#active');

    //banner
    Route::get('banners/list', [BannerController::class, 'bannerlist'])->name('banners#list');
    Route::post('banners/update', [BannerController::class, 'bannerUpdate'])->name('banner#update');

    //photo gallery
    Route::get('gallery/list', [photoGalleryController::class, 'gallerylist'])->name('gallery#list');
    Route::get('gallery/add', [photoGalleryController::class, 'galleryAdd'])->name('gallery#add');
    Route::post('gallery/save', [photoGalleryController::class, 'gallerySave'])->name('gallery#save');
    Route::get('gallery/edit/{id}', [photoGalleryController::class, 'galleryEdit'])->name('gallery#edit');
    Route::post('gallery/update', [photoGalleryController::class, 'galleryUpdate'])->name('gallery#update');
    Route::post('gallery/delete/{id}', [photoGalleryController::class, 'galleryDelete'])->name('gallery#delete');


    //video gallery
    Route::get('video/gallery/list', [VideoGalleryController::class, 'videoGalleryList'])->name('video#gallery#list');
    Route::get('video/gallery/add', [VideoGalleryController::class, 'videoGalleryAdd'])->name('video#gallery#add');
    Route::post('video/gallery/save', [VideoGalleryController::class, 'videoGallerySave'])->name('video#gallery#save');
    Route::get('video/gallery/edit/{id}', [VideoGalleryController::class, 'videoGalleryEdit'])->name('video#gallery#edit');
    Route::post('video/gallery/update', [VideoGalleryController::class, 'videoGalleryUpdate'])->name('video#gallery#update');
    Route::post('video/gallery/delete/{id}', [VideoGalleryController::class, 'videoGalleryDelete'])->name('video#gallery#delete');

    //manage role and news post settings
    Route::get('admin/list', [AdminController::class, 'adminList'])->name("admin#list");
    Route::post('admin/profile/store', [AdminController::class, 'adminProfileStore'])->name("admin#profile#store");
    Route::get('admin/change/password', [AdminController::class, 'adminChangePassword'])->name("admin#change#password");
    Route::post('admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name("admin#update#password");

    Route::get('admin/add', [AdminController::class, 'adminAdd'])->name("admin#add");
    Route::post('admin/store', [AdminController::class, 'adminStore'])->name("admin#store");
    Route::get('admin/edit/{id}', [AdminController::class, 'adminEdit'])->name("admin#edit");
    Route::post('admin/update', [AdminController::class, 'adminUpdate'])->name("admin#update");
    Route::get("admin/delete/{id}", [AdminController::class, 'adminDelete'])->name("admin#delete");

});


Route::middleware(['auth', 'role:user'])->group(function() {

    // permission user or admin
    Route::get('/user/frontend/dashboard', [UserController::class, 'UserFrontendDashboard'])->name('user#frontend#dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user#profile#store');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user#change#password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user#update#password');

});


//normal user or no account user
Route::get('newspost/details/{id}/{slug}', [NewspostController::class, 'newspostDetails'])->name('newspost#details');
Route::get('newspost/category/{id}/{slug}', [NewspostController::class, 'newspostCategory'])->name('newspost#category');
Route::get('newspost/subcategory/{id}/{slug}', [NewspostController::class, 'newspostSubcategory'])->name('newspost#subcategory');
