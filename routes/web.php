<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
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

Route::get('/single', function () { return view('single'); })->name('single');
Route::get('/post', function () { return view('post'); })->name('post');
// Route::get('/profile', function () { return view('profile'); })->name('profile');
// Route::get('/edit-profile', function () { return view('edit-profile'); })->name('edit-profile');


Route::get('/login', function () {
    return view('auth/login');
})->name('login');
Route::get('/register', function () {
    return view('auth/register');
})->name('register');


Route::post('/register', [RegisterController::class, 'register'])->name('register.user');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('/update-profile', [ProfileController::class, 'update'])->name('update-profile');

    
});

