<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleController;
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


Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/login', [UserLoginController::class, 'login'])->name('user.login');
Route::post('/authenticate', [UserLoginController::class, 'authenticate'])->name('user.authenticate');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
Route::get('/register', [UserLoginController::class, 'register'])->name('user.signup');
Route::post('/store', [UserLoginController::class, 'store'])->name('user.register');
Route::get('/pages/view/{id}', [UserController::class, 'view'])->name('user.view');
Route::get('/user/search', [UserController::class, 'userSearch'])->name('user.search');
Route::post('/user/like/{id}', [UserController::class, 'likePost'])->name('user.like');
Route::post('/user/comment/{id}', [UserController::class, 'commentOnPost'])->name('user.comment');

Route::get('/alogin', [UserLoginController::class, 'alogin'])->name('user.login');


Route::get('/authenticate/redirect/{social}', [UserController::class, 'fbRedirect'])->name('facebook-redirect');
Route::get('/authenticate/callback/{social}', [UserController::class, 'fbCallback'])->name('facebook-callback');

Route::get('login/redirect/{social}', [UserController::class, 'googleRedirect'])->name('google-redirect');
Route::get('login/callback/{social}', [UserController::class, 'googleCallback'])->name('google-callback');

// Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin', AdminController::class);
    Route::get('/showCategory', [AdminController::class, 'showCategory'])->name('admin.showCategory');
    Route::get('/addCategory', [AdminController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('/storeCategory', [AdminController::class, 'storeCategory'])->name('admin.storeCategory');
    Route::get('/showEcategory/{id}', [AdminController::class, 'showEcategory'])->name('admin.showEcategory');
    Route::put('/updateCategory/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('/admin/category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.deleteCategory');
});
