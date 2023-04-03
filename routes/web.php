<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeaponsController;
use App\Http\Controllers\FavoritesController;

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

//Root page -> send to homepage
Route::get('/', function () {
    return view('homepage');
});

//-----------------------------Accounts----------------------------------------------
Route::get('/createaccount', [UserController::class, 'create']);
//add user to database
Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/users/loginuser', [UserController::class, 'loginuser']);




//--------------------------------------------Dashboard------------------------------------
//display favorites on dashboard
Route::get('/dashboard', [WeaponsController::class, 'dashboard']);

//---------------------------Sections (Weapons + Warframes)---------------------------------------
//Primary Weapons
Route::get('/primary', [WeaponsController::class, 'primary_call']);

//Secondary 
Route::get('/secondary', [WeaponsController::class, 'secondary_call']);

//Melee 
Route::get('/melee', [WeaponsController::class, 'melee_call']);

//Warframes
Route::get('/warframes', [WeaponsController::class, 'warframe_call']);
Route::get('/warframes/{warframe}', [WeaponsController::class, 'warframe_call_single']);

//-------------------------Individual pages (from sections)---------------------------------
//Weapon call
Route::get('/{type}/{weapon}', [WeaponsController::class, 'weapon_call']);


//-----------------------------------------POSTs--------------------------------------------
//Add favorites to database
Route::post('/warframes', [FavoritesController::class, 'store'])->name('favorites.store');

//remove from favorites
Route::post('/dashboard', [FavoritesController::class, 'destroy'])->name('favorites.destroy');

//remove from favorites
Route::post('/dashboard/aquire', [FavoritesController::class, 'component_acquired'])->name('component.component_acquired');
