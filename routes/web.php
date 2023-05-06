<?php

use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
});

Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{user}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{user}/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}/destroy', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');

});

Route::middleware('auth')->group(function (){
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/{user}/add-friend', [UserController::class, 'addFriend'])->name('users.add-friend');


});
Route::middleware('auth')->group(function (){
    Route::get('/friendship', [FriendshipController::class, 'index'])->name('friendship.index');
    Route::get('/{friendship}/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/requests',[FriendshipController::class,'showRequests'])->name('friendship.friend-request');
    Route::put('/friendship/{friendship}/update', [FriendshipController::class, 'update'])->name('friendship.update');
    Route::delete('/friendship/{friendship}/destroy', [FriendshipController::class, 'destroy'])->name('friendship.destroy');
    Route::post('message/send',[MessageController::class,'store'])->name('message.send');



});


require __DIR__.'/auth.php';
