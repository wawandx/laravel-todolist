<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TodoController::class)->group(function() {
    Route::get('/todo', 'index')->name('todo');
    Route::post('/todo', 'store')->name('todo.post');
    Route::put('/todo/{id}', 'update')->name('todo.update');
    Route::delete('/todo/{id}', 'destroy')->name('todo.delete');
});