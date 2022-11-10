<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();
Route::post('login', [HomeController::class, 'login'])->name('logueo');
Route::post('store-user', [HomeController::class, 'storeUser']);
Route::get('update-user/{id}', [HomeController::class, 'updateUser']);
Route::post('actualizar-usuario/{id}', [HomeController::class, 'updateUserId']);
Route::post('delete-user', [HomeController::class, 'deleteUser']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('search-users', [HomeController::class, 'search']);
Route::post('/download-pdf', [HomeController::class, 'downloadPDF']);

