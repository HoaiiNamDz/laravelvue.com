<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\User\UserGroupController;
use App\Http\Controllers\Api\V1\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// AUTH
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
// Route::get('/auth/getAuthCookie', [AuthController::class, 'getAuthCookie'])->name('login');

// USERS GROUP
Route::get('/users/group', [UserGroupController::class, 'index'])->name('users.group');
Route::post('/users/group/create', [UserGroupController::class, 'create'])->name('users.group.create');

Route::delete('/users/group/delete', [UserGroupController::class, 'delete'])->name('users.group.delete');
Route::delete('/users/group/deleteMultiple', [UserGroupController::class, 'deleteMultiple'])->name('users.group.deleteMultiple');

Route::put('/users/group/update', [UserGroupController::class, 'update'])->name('users.group.update');
Route::put('/users/group/update/status', [UserGroupController::class, 'updateStatus'])->name('users.group.update.status');
Route::put('/users/group/update/status/multiple', [UserGroupController::class, 'updateStatusMultiple'])->name('users.group.update.status.multiple');

// USERS
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::put('/users/update/status', [UserController::class, 'updateStatus'])->name('users.update.status');
Route::put('/users/update/status/multiple', [UserController::class, 'updateStatusMultiple'])->name('users.update.status.multiple');