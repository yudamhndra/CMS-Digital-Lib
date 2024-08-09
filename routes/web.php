<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
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
    Route::get('/buku', [BooksController::class, 'index'])->name('books.index');
    Route::get('/buku/create', [BooksController::class, 'create'])->name('books.create');
    Route::post('/buku', [BooksController::class, 'store'])->name('books.store');
    Route::get('/buku/{book}', [BooksController::class, 'show'])->name('books.show');
    Route::get('/buku/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');
    Route::put('/buku/{book}', [BooksController::class, 'update'])->name('books.update');
    Route::delete('/buku/{book}', [BooksController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/{id}/export/pdf', [BooksController::class, 'exportPDF'])->name('books.export.pdf');
});

Route::middleware('auth')->group(function (){
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
});



require __DIR__.'/auth.php';
