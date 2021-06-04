<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', ['App\Http\Controllers\Frontend\HomeController', 'index'])->name('home');
Route::get('/blog', ['App\Http\Controllers\Frontend\BlogController', 'index'])->name('blog');
Route::get('/blog/cat-{category_id}', ['App\Http\Controllers\Frontend\BlogController', 'index'])->name('blog_category');
Route::get('/blog/{post_id}/details', ['App\Http\Controllers\Frontend\BlogController', 'details'])->name('blog_details');
Route::post('/blog/get_voucher_code', ['App\Http\Controllers\Frontend\BlogController', 'get_voucher_code'])->name('blog_get_voucher_code');

Route::group(['prefix'=>'backend', 'middleware'=>['can:isAdmin'] , 'as'=>'backend.'], function() {
    // Dashboard
    Route::get('/', ['App\Http\Controllers\Backend\DashboardController', 'index'])->name('dashboard');
    // Blogs
    Route::group(['prefix'=>'blogs', 'as'=>'blogs.'], function() {
        Route::group(['prefix'=>'posts','as'=>'posts.'],function() {
            Route::get('/', ['App\Http\Controllers\Backend\Blogs\PostsController', 'list'])->name('list');
        });
        Route::group(['prefix'=>'categories','as'=>'categories.'],function() {
            Route::get('/', ['App\Http\Controllers\Backend\Blogs\CategoriesController', 'list'])->name('list');
        });
    });
});
