<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerBuku;

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

Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/buku', [ControllerBuku::class, 'index']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/buku', [ControllerBuku::class, 'index']);
    Route::get('/buku/create', [ControllerBuku::class, 'create'])->name('buku.create');
    Route::post('/buku', [ControllerBuku::class, 'store'])->name('buku.store');
    Route::delete('/buku/{id}', [ControllerBuku::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/edit/{id}', [ControllerBuku::class, 'edit'])->name('buku.edit');
    Route::post('/buku/update/{id}', [ControllerBuku::class, 'update'])->name('buku.update');
    Route::get('/buku/search', [ControllerBuku::class, 'search'])->name('buku.search');
});

require __DIR__.'/auth.php';
