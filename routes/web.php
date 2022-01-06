<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FB\FacebookController;

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
    if (Auth::check()) {
        return Redirect::route('fb.index');
    } else {
        return Redirect::to('/login');
    }
});

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::group(['prefix' => 'fb', 'middleware' => ['web', 'auth']], function() {
    Route::get('index', [FacebookController::class, 'index'])->name('fb.index');
    Route::get('login', [FacebookController::class, 'login'])->name('fb.login');
    Route::get('list', [FacebookController::class, 'list'])->name('fb.list');
    Route::post('subscribe', [FacebookController::class, 'subscribe'])->name('fb.subscribe');
});
