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

Route::get('/booking', function () {
    return view('booking');
})->middleware(['auth', 'verified'])->name('booking');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('/car', CarController::class);

    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');

    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');
    // Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::patch('/rental/{rental}', [RentalController::class, 'update'])->name('rental.update');
    Route::patch('/rental/{rental}/complete', [RentalController::class, 'complete'])->name('rental.complete');
    Route::patch('/rental/{rental}/incomplete', [RentalController::class, 'uncomplete'])->name('rental.uncomplete');
    Route::delete('/rental/{rental}', [RentalController::class, 'destroy'])->name('rental.destroy');
    Route::delete('/rental', [RentalController::class, 'destroyCompleted'])->name('rental.deleteallcompleted');


    Route::get('/car', [CarController::class, 'index'])->name('car.index');
    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::patch('/car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::delete('/car/{car}', [CarController::class, 'destroy'])->name('car.destroy');

});

require __DIR__.'/auth.php';
