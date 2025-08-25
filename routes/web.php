<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FiturController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\CaraKerjaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\HasilAnalisisController;
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

Route::get('/', function () {return view('page.dashboard');})->name('page.dashboard');
Route::get('/fitur', [FiturController::class, 'index'])->name('page.fitur');
Route::get('/harga', [HargaController::class, 'index'])->name('page.harga');
Route::get('/cara_kerja', [CaraKerjaController::class, 'index'])->name('page.cara_kerja');
Route::get('/review', [ReviewController::class, 'index'])->name('page.review');


// Route::get('/dashboard', function () {
//     return view('page.dashboard');
// })->middleware(['auth', 'verified'])->name('page.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/analisis', [AnalisisController::class, 'index'])->name('page.analisis');
    Route::get('/hasil_analisis', [HasilAnalisisController::class, 'index'])->name('page.hasil_analisis');
    Route::get('/dashboard', function () {return view('page.dashboard');})->name('page.dashboard');
    Route::post('/analisis/upload', [AnalisisController::class, 'store'])->name('analisis.store');
});

require __DIR__.'/auth.php';
