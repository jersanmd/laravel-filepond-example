<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'welcome']);
Route::post('/', [PostController::class, 'store']);

Route::post('/tmp-upload', [PostController::class, 'tmpUpload']);
Route::delete('/tmp-delete', [PostController::class, 'tmpDelete']); 
