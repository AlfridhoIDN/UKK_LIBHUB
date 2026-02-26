<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('landingpage');
Route::get('explore-category', [DashboardController::class, 'category'])->name('category');
Route::get('book-detail/{id}', [DashboardController::class, 'show'])->name('landingpage.book');

Route::group(['prefix' => '/'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('register',[UserController::class,'create'])->name('account.create');
        Route::post('register',[UserController::class,'store'])->name('account.store');

        Route::get('login',[UserController::class,'login'])->name('login');
        Route::post('login',[UserController::class,'authenticate'])->name('account.authenticate');

        Route::get('account/google/redirect', [UserController::class, 'redirectToGoogle'])->name('account.google.redirect');
        Route::get('account/google/callback', [UserController::class, 'handleGoogleCallback']);
    });
    // Route::group(['middleware' => 'auth'], function(){
        Route::get('logout',[UserController::class,'logout'])->name('account.logout');

        
        Route::get('user/settings', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('user/history', [HistoryController::class,'index'])->name('user.history');
        Route::get('user/loans',[LoanController::class,'view'])->name('user.loan');

        Route::get('user/favorite', [FavoriteController::class,'index'])->name('user.favorite.index');
        Route::post('user/favorite', [FavoriteController::class,'store'])->name('user.favorite.store');

        Route::get('loan/form/{id}',[LoanController::class, 'create'])->name('book.loan.index');
        Route::post('loan/form',[LoanController::class,'store'])->name('book.loan.create');
        Route::middleware(['admin'])->group(function (){
            Route::get('admin/staff-data',[StaffController::class,'index'])->name('admin.staff.index');
            Route::get('admin/staff-data/registration',[StaffController::class,'create'])->name('admin.staff.create');
            Route::post('admin/staff-data/registration',[StaffController::class,'store'])->name('admin.staff.store');
            
            Route::get('admin/staff-data/update-data/{id}', [StaffController::class, 'edit'])->name('admin.staff.edit');
            Route::put('admin/staff-data/update-data/{id}', [StaffController::class, 'update'])->name('admin.staff.update');
            
            Route::get('admin/staff-data/detail-data/{id}',[StaffController::class, 'show'])->name('admin.staff.show');
            Route::delete('admin/staff-data/delete/{id}', [StaffController::class, 'destroy'])->name('admin.staff.delete');
            });

        Route::group(['middleware' => ['admin_or_staff']],function(){
            Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
            
            Route::get('user-data',[UserController::class, 'index'])->name('user.index');
            Route::get('user-data/detail-user-data/{id}',[UserController::class,'show'])->name('user.show');
            
            Route::get('category-data',[CategoryController::class,'index'])->name('category.index');
            Route::get('category-data/create',[CategoryController::class, 'create'])->name('category.create');
            Route::post('category-data/create',[CategoryController::class, 'store'])->name('category.store');
            
            Route::get('category-data/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
            Route::put('category-data/edit/{id}',[CategoryController::class, 'update'])->name('category.update');
            Route::delete('category-data/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

            Route::get('book-data', [BookController::class, 'index'])->name('book.index');
            Route::get('book-data/create', [BookController::class, 'create'])->name('book.create');
            Route::post('book-data/create', [BookController::class,'store'])->name('book.store');
            
            Route::get('book-data/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
            Route::put('book-data/edit/{id}', [BookController::class, 'update'])->name('book.update');

            Route::get('book-data/detail-book/{id}',[BookController::class,'show'])->name('book.show');
            Route::delete('book-data/delete/{id}',[BookController::class,'destroy'])->name('book.delete');
            
            Route::get('loan-data',[LoanController::class, 'index'])->name('loan.index');
            Route::put('loan-data/update-loan/{id}',[LoanController::class,'update'])->name('book.loan.update');
        });
    // });
});