<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\routes\api;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\VersionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('version', VersionController::class);
Route::resource('subject', SubjectController::class);
Route::resource('class', ClassesController::class);
Route::resource('quiz', QuizController::class);
