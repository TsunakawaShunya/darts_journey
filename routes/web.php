<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\SpotController;

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

Route::get('/users/{user}/trip/index', [TripController::class, 'index'])->middleware('auth')->name('trip.index');
Route::post('/users/{user}/trip/input', [ParameterController::class, 'post_parameter'])->middleware('auth');
Route::get('/users/{user}/trip/darts', [ParameterController::class, 'show_darts'])->middleware('auth');
Route::post('/users/{user}/trip/list', [SpotController::class, 'create_spots'])->middleware('auth');
Route::get('/users/{user}/trip/list', [TripController::class, 'show_list'])->middleware('auth');


require __DIR__.'/auth.php';
