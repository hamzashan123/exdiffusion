<?php

use App\Http\Controllers\ModelsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/', function () {
    return view('frontend.playground');
});

Route::get('/', function () {
    return view('frontend.playground');
});

Route::get('/', function () {
    return view('frontend.playground');
});

Route::get('/', function () {
    return view('frontend.playground');
});


Route::get('/get-base-models',[ModelsController::class, 'getBaseModels'])->name('getbasemodels');
Route::get('/get-schedulers',[ModelsController::class, 'getSchedulers'])->name('getschedulers');
Route::post('/generate-images',[ModelsController::class, 'generateImages'])->name('generateImages');
Route::post('/get-superResolution',[ModelsController::class, 'getSuperResolutionImage'])->name('getSuperResolutionImage');
Route::post('/save-superResolution',[ModelsController::class, 'saveSuperResolutionImage'])->name('saveSuperResolutionImage');
Route::post('/restart',[ModelsController::class, 'restartServer'])->name('restart');