<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
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

Route::get('/',[ContactController::class,'index']);
Route::post('/fix', [ContactController::class, 'fix']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', function () {
    return view('thanks');
});

Route::post('/register',[AuthController::class,'registerStore']);
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore']);
});
Route::middleware('auth')->group(function (){
Route::get('/admin',[AuthController::class,'admin']);
Route::delete('/admin/delete',[AuthController::class,'delete']);
Route::post('/logout',[AuthController::class,'logout']);
});
