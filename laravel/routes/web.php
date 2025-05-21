<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportTicketController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/shop', [ProductController::class, 'index'])->middleware(['auth'])->name('shop');


Route::get('/support', function () {
    return view('support');
})->middleware(['auth'])->name('support');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add/{id}', [BasketController::class, 'add'])->name('basket.add');
    Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');
    Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');
    Route::post('/basket/pay', [BasketController::class, 'pay'])->name('basket.pay');
    Route::post('/support', [SupportTicketController::class, 'store'])->name('support.store');
});

require __DIR__ . '/auth.php';
