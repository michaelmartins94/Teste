<?php

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

Route::get('/', [App\Http\Controllers\ClimaController::class, 'index'])->name('clima');
Route::post('/add', [App\Http\Controllers\ClimaController::class, 'add'])->name('clima.add');
Route::post('/edit', [App\Http\Controllers\ClimaController::class, 'edit'])->name('clima.edit');
Route::delete('/delete', [App\Http\Controllers\ClimaController::class, 'delete'])->name('clima.delete');
