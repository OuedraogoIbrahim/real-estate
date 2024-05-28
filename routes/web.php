<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComptaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/presentation', [NavController::class, 'presentation'])->name('presentation');
Route::get('/contact', [NavController::class, 'contact_form'])->name('contact');
Route::post('/contact', [NavController::class, 'contact']);

Route::get('/estimer', [NavController::class, 'estimer'])->name('estimation');

Route::get('/Nos-biens', [ListingController::class, 'index'])->name('nos_biens');
Route::get('/immeuble/{titre}/{appartement}', [ListingController::class, 'show'])->where(['titre', '[0-9a-z]+', 'appartement', '[0-9]+'])
    ->name('show.immeuble');


Route::resource('/admin', AdminController::class)->names('admin');

Route::get('/register', [RegisterController::class, 'registerform'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/confirm/{id}/{token}', [RegisterController::class, 'register_confirmation'])->where('id', '[0-9]+')->name('register.confirmation');

Route::get('/login', [LoginController::class, 'loginform'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::get('/compta', [ComptaController::class, 'index'])->name('compta');
Route::post('/compta', [ComptaController::class, 'treat']);

Route::get('journal', [ComptaController::class, 'afficher']);
