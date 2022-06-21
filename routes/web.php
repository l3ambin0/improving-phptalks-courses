<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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

Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'list']);
Route::get('/courses/{course}', [CourseController::class, 'detail']);