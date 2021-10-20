<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\ItemsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list/create', [ListsController::class, 'index'])->name('list.create');
Route::post('/list/store', [ListsController::class, 'store'])->name('list.store');
Route::get('/list/view/{id}', [ListsController::class, 'show'])->name('list.view');
Route::get('/list/delete/{id}', [ListsController::class, 'destroy'])->name('list.delete');
Route::get('/list/{id?}/item/create', [ItemsController::class, 'create'])->name('item.create');
Route::post('/items/store', [ItemsController::class, 'store'])->name('items.store');
Route::get('/item/mark_completed/{itemId?}', [ItemsController::class, 'markCompleted'])->name('item.mark_completed');
Route::get('/item/delete/{itemId?}', [ItemsController::class, 'destroy'])->name('item.delete');
