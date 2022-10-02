<?php

use App\Http\Controllers\Guest\LoginController;
use App\Http\Controllers\Guest\PasswordResetController;
use App\Http\Controllers\Guest\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;



//login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('user.register');

//verify mail
// Route::get('/verify/{user_id}/{token}', [RegisterController::class, 'verifymail'])->name('verify.mail');

//password reset
Route::get('/forgotpassword', [PasswordResetController::class, 'index'])->name('forgetpassword');
Route::post('/resetlink', [PasswordResetController::class, 'resetLink'])->name('resetLink.mail');

//reset link to mail
Route::get('/resetpassword/{user_id}/{token}', [PasswordResetController::class, 'resetpassword'])->name('reset.link');
Route::post('/reset/{user_id}/{token}', [PasswordResetController::class, 'finalreset'])->name('reset.password');

//home for auth users
Route::get('/home', [HomeController::class, 'index'])->name('home');







Route::post('/add-result/{profile_id}/{level_id}', [ResultController::class, 'add_result'])->name('add_result');

Route::post('/add-profile', [ProfileController::class, 'add_profile'])->name('add_profile');

Route::get('/delete-profile/{profile_id}', [ProfileController::class, 'delete_profile'])->name('delete_profile');


Route::get('/levels/{profile_id}', [LevelController::class, 'index'])->name('level');

Route::post('/add-level/{profile_id}', [LevelController::class, 'add_level'])->name('add_level');

Route::get('/results/{profile_id}/{level_id}', [ResultController::class, 'index'])->name('result');

Route::post('/remove-course/{profile_id}/{semester}/{key}/{level_id}', [ResultController::class, 'remove_course'])->name('remove_course');