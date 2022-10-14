<?php

use App\Http\Controllers\ContractsController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\ZohoController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [ HomeController::class, 'welcome']);
Route::get('/zoho/auth', [ ZohoController::class, 'auth'])->middleware('auth');

Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
    Route::get('create', [ ContractsController::class, 'create'])
        ->name('create')->middleware('auth');
    Route::get('index', [ ContractsController::class, 'index'])
        ->name('index')->middleware('auth');
});

Route::group(['prefix' => 'deals', 'as' => 'deals.'], function () {
    Route::get('create', [ DealsController::class, 'create'])
        ->name('create')->middleware('auth');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
