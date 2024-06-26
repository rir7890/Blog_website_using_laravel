<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\UserLoggedIn;
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
    return view('register');
})->name('home');

Route::post('/register',[UserController::class,'register'])->name('register.user');
Route::get('/login',[UserController::class,'login'])->name('loginPage');
Route::post('/loginUser',[UserController::class,'loginUser'])->name('login.user');
Route::get('/allblogs',[BlogController::class,'showAllBlogs'])->name('all.blogs');
Route::get('/myblog/{id}',[BlogController::class,'myBlog'])->name('blog.show');

Route::middleware([UserLoggedIn::class])->group(function () {
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[UserController::class,'logout'])->name('logout.user');
    Route::get('/userEdit',[UserController::class,'userEdit'])->name('profile.edit');
    Route::put('/profile-edit',[UserController::class,'profileUpdate'])->name('profile.update');
    Route::get('/blogpage',[BlogController::class,'blogPage'])->name('blog.page');
    Route::post('/blogcreate',[BlogController::class,'createBlog'])->name('blog.create');
    Route::get('/myblog',[BlogController::class,'myBlogs'])->name('my.blogs');
    Route::put('/myblogedit/{id}',[BlogController::class,'myBlogEdit'])->name('blog.edit');
    Route::delete('/myblogdelete/{id}',[BlogController::class,'myBlogDelete'])->name('blog.destroy');

    Route::middleware([AuthAdmin::class])->group(function(){
        Route::get('/adminPage',[AdminController::class,'adminPage'])->name('admin.dashboard');
        Route::delete('/adminDeleteuser',[AdminController::class,'adminDeleteUser'])->name('admin.deleteUser');
        Route::get('/adminUserBlogs/{id}',[AdminController::class,'getAllBlogs'])->name('admin.userblogs');
        Route::delete('/adminDeleteUserBlog/{id}',[AdminController::class,'deleteUserBlogs'])->name('admin.destroy.blog');
    });
});