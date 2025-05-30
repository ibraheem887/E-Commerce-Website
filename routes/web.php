<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\View\Components\Message;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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



Route::get('register',[AdminController::class,'index'])->name('show.register');
Route::post('register',[AdminController::class,'store'])->name('admin.store');
Route::get('adminloginPage',[AdminController::class,'loginpage']);
Route::get('login',[AdminController::class,'login'])->name('login');
Route::get('logout',[AdminController::class,'logout']);

Route::group(['middleware'=>['protectedPage',]],function()
{
    Route::resource('category',CategoryController::class);
    Route::resource('products',ProductController::class);
 });
   
 
 

