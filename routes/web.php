<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActionLogController;

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

// User Login & Register Route
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** User's action log grid */
    Route::get('/action-log', [ActionLogController::class, 'index'])->name('action-log');

    Route::prefix('users')->group(function () {
        Route::name('users.')->group(function () {
            /** Grid */
            Route::get('/', [UserController::class, 'index'])->name('grid');


            /** Add, Update, Delete */
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('/update', [UserController::class, 'update'])->name('update');
            Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');

            /** Trashed User Grid */
            Route::get('/trashed', [UserController::class, 'trashedView'])->name('trashed');

            /** Restoring Trashed Users */
            Route::get('/trashed-restore', [UserController::class, 'TrashedRestore'])->name('restore');
            Route::delete('/trashed-delete', [UserController::class, 'trashedDelete'])->name('force_delete');
        });
    });
});

require __DIR__.'/auth.php';
