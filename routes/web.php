<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'index']);


Route::get('/usermanagement', [CarController::class, 'userList'])->name('user.list');

Route::get('/userinfo/{id}', [CarController::class, 'userInfo'])->name('user.info');

