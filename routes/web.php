<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PageObjectController;
use App\Http\Controllers\TextBoxController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('pages', PageController::class);
    Route::resource('page_objects', PageObjectController::class);
    Route::resource('text_boxes', TextBoxController::class);
});
