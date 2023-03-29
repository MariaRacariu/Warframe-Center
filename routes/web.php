<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('homepage');
});

Route::get('/createaccount', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/dashboard', function () {
    if (Auth::check()) {
        return view('dashboard');
    }
    return view('users.login');
});

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/users/loginuser', [UserController::class, 'loginuser']);

Route::get('/warframes', function () {
    return view('single.warframes');
});

Route::get('/primary', function () {
    return view('single.primary-weapons');
});

Route::get('/secondary', function () {
    return view('single.secondary-weapons');
});

Route::get('/melee', function () {
    return view('single.melee-weapons');
});
