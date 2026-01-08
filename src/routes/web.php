<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompleteController;

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

Route::middleware('auth')->group(function() {
    Route::get('/', [TodoController::class, 'index'])
        ->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])
        ->name('todos.store');
    Route::patch('/todos/{todo}', [TodoController::class, 'update'])
        ->name('todos.update');
    Route::patch('/todos/{todo}/complete', [TodoController::class, 'complete'])
        ->name('todos.complete');
    Route::get('/todos/search', [TodoController::class, 'search'])
        ->name('todos.search');

    // category page
    Route::get('/category', [CategoryController::class, 'index'])
        ->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])
        ->name('category.store');
    Route::patch('/category/update/{category}', [CategoryController::class, 'update'])
        ->name('category.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])
        ->name('category.delete');

    // complete page
    Route::get('/todos/completed', [CompleteController::class, 'index'])
        ->name('todos.completed');
    Route::patch('/todos/{todo}/incomplete', [CompleteController::class, 'incomplete'])
        ->name('todos.incomplete');
    Route::delete('/todos/{todo}', [CompleteController::class, 'destroy'])
        ->name('todos.delete');
});