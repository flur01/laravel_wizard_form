<?php

use App\Http\Controllers\GetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GetController::class, 'mainPage'])->name('main-page');
Route::get('/all-members', [GetController::class, 'allMembers'])->name('all-members');
Route::get('/get-all-members', [GetController::class, 'getAllMembers']);
Route::post('/add-user', [PostController::class, 'addUser']);
Route::post('/add-info', [PostController::class, 'addInfo']);
Route::post('/change-visible', [PostController::class, 'changeMembersVisible']);
Auth::routes(['register' => false, 'reset' => false, 'verify' => false,]);
Route::get('/admin', [AdminController::class, 'adminAllMembers'])->name('admin');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
