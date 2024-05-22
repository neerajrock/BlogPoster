<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;

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
Route::get('/',[BlogController::class,'index'])->name('home');
Auth::routes();
Route::get('/profile',[ProfileController::class,'index'])->middleware('auth')->name('myprofile');

Route::prefix('Blog')->controller(BlogController::class)->middleware('auth')->group(function(){
    Route::post('/posted','storeblog')->name('add.blog.poter');
});

Route::get('blog/details',[BlogController::class,'blogpagefun'])->name('blog.detals');