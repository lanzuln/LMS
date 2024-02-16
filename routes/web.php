<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\instructor\InstructorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//============  admin  ==================
Route::get('/admin/login', [AdminController::class, 'adminLogin']) ->name('admin.login');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/password', [AdminController::class, 'adminPassword'])->name('admin.password');
    Route::post('/admin/password/change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::get('/admin/logout', [AdminController::class, 'destroy']) ->name('admin.logout');
});


//============  Instructor  ==================
Route::get('/instructor/login', [InstructorController::class, 'instructorLogin']) ->name('instructor.login');

Route::middleware(['auth', 'roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::get('/instructor/profile', [InstructorController::class, 'instructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/update', [InstructorController::class, 'instructorProfileUpdate'])->name('instructor.profile.update');
    Route::get('/instructor/password', [InstructorController::class, 'instructorPassword'])->name('instructor.password');
    Route::post('/instructor/password/change', [InstructorController::class, 'instructorPasswordChange'])->name('instructor.password.change');
    Route::get('/instructor/logout', [InstructorController::class, 'destroy']) ->name('instructor.logout');
});

// Route::middleware(['auth', 'roles:instructor'])->group(function () {
//     Route::get('/instructor/dashboard', [InstructorController::class, 'index']);
// });
