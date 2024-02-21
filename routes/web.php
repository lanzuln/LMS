<?php

use App\Http\Controllers\backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\frontendIndexController;
use App\Http\Controllers\backend\instructor\InstructorController;

// ================== frontend ===========
Route::get('/', [frontendIndexController::class, 'index']);
Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/user/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/user/change/password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/user/update/password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/user/logout', [UserController::class, 'destroy'])->name('user.logout');

});

require __DIR__ . '/auth.php';

//============  admin  ==================
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        Route::post('/admin/profile/update', 'adminProfileUpdate')->name('admin.profile.update');
        Route::get('/admin/password', 'adminPassword')->name('admin.password');
        Route::post('/admin/password/change', 'adminPasswordChange')->name('admin.password.change');
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update', 'update')->name('category.update');
        Route::post('/category/delete/{id}', 'delete')->name('category.delete');
    });



});


//============  Instructor  ==================
Route::get('/instructor/login', [InstructorController::class, 'instructorLogin'])->name('instructor.login');

Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::get('/instructor/profile', [InstructorController::class, 'instructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/update', [InstructorController::class, 'instructorProfileUpdate'])->name('instructor.profile.update');
    Route::get('/instructor/password', [InstructorController::class, 'instructorPassword'])->name('instructor.password');
    Route::post('/instructor/password/change', [InstructorController::class, 'instructorPasswordChange'])->name('instructor.password.change');
    Route::get('/instructor/logout', [InstructorController::class, 'destroy'])->name('instructor.logout');
});

// Route::middleware(['auth', 'roles:instructor'])->group(function () {
//     Route::get('/instructor/dashboard', [InstructorController::class, 'index']);
// });
