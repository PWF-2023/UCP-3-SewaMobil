<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
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

    // Route::resource('/car', CarController::class);

    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');


    Route::get('/car', [CarController::class, 'index'])->name('car.index');
    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::patch('/car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::delete('/car/{car}', [CarController::class, 'destroy'])->name('car.destroy');

});

require __DIR__.'/auth.php';
