<?php

use App\Http\Controllers\CircleController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageObjectController;
use App\Http\Controllers\RectangleController;
use App\Http\Controllers\TextBoxController;
use App\Http\Controllers\TriangleController;
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

Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::resource('contact_messages', ContactMessageController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', function () {
        return redirect('pages');
    })->name('dashboard');
    Route::resource('pages', PageController::class);
    Route::resource('page_objects', PageObjectController::class);
    Route::resource('text_boxes', TextBoxController::class);
    Route::resource('rectangles', RectangleController::class);
    Route::resource('triangles', TriangleController::class);
    Route::resource('images', ImageController::class);
    Route::resource('circles', CircleController::class);
});