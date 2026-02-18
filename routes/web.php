<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('landingpage');
Route::get('explore-category', [DashboardController::class, 'category'])->name('category');
Route::get('/test-alert', function() {
    return redirect()->route('login')->with('error', 'Ini tes alert error!');
});

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

        Route::middleware(['admin'])->group(function (){
            Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

            Route::get('admin/staff-data',[StaffController::class,'index'])->name('admin.staff.index');
            Route::get('admin/staff-data/registration',[StaffController::class,'create'])->name('admin.staff.create');
            Route::post('admin/staff-data/registration',[StaffController::class,'store'])->name('admin.staff.store');

            Route::get('admin/staff-data/update-data/{id}', [StaffController::class, 'edit'])->name('admin.staff.edit');
            Route::put('admin/staff-data/update-data/{id}', [StaffController::class, 'update'])->name('admin.staff.update');

            Route::get('admin/staff-data/detail-data/{id}',[StaffController::class, 'show'])->name('admin.staff.show');
        });

        Route::group(['middleware' => ['admin_or_staff']],function(){
            Route::get('user-data',[UserController::class, 'index'])->name('user.index');
            Route::get('user-data/detail-user-data/{id}',[UserController::class,'show'])->name('user.show');
        });
    // });
});