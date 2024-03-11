<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return view('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('/home', function () {
        return Inertia::render("Dashboard/Index");
    })->name('dashboard');
});
Route::middleware(['redirect.if.authenticated'])->group(function () {
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::inertia('/forgot-password', 'Auth/ForgotPassword')->name('password.reset');
});
