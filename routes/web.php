<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;

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

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'Admin'],function(){
    // Dashboard 
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Post
    Route::get('post', function () {
        return view('post');
    })->name('post');


    Route::post('logout', [AdminController::class,'logout'])
        ->name('logout');
});

// Route::middleware(['Admin'])->group(['prefix'=>'admin'],function (){
 
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::post('logout', [AdminController::class,'logout'])
//         ->name('logout');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard1');
// })->name('dashboard');


require __DIR__.'/auth.php';
