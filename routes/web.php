<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('login', [AdminController::class, 'login'])
->name('login');

Route::post('login_submit', [AdminController::class, 'login_submit'])
->name('login_submit');

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'Admin'],function(){
    // Dashboard 
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    //Post
    Route::resource('post', PostController::class);

    // Users
    Route::resource('users', UserController::class);

    // Role
    Route::resource('roles', RoleController::class);


    Route::post('logout', [AdminController::class,'logout'])
        ->name('logout');
});