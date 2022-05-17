<?php

use App\Http\Controllers\InputCheckController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('order', TransactionController::class);
    Route::post('order/confirmation', [TransactionController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/check', [InputCheckController::class, 'index'])->name('check');
    Route::post('/check/process', [InputCheckController::class, 'process'])->name('check.process');
});

require __DIR__.'/auth.php';
