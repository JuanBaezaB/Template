<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /*Route::get('/user', function () {
        $users = User::all();
        return Inertia::render('User', compact('users'));
    })->name('user.index');*/
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/dashboard/user', [UserController::class, 'store'])->name('user.store');
    Route::patch('/dashboard/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/dashboard/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');


    Route::get('/dashboard/branch', [BranchController::class, 'index'])->name('branch.index');
});

//Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->resource('/dashboard/user', UserController::class);
