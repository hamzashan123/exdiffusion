<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\ModelsController;
use App\Http\Controllers\Backend\InvitationController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/',function(){
        if(Auth::user()){
            return view('frontend.exdiffusion.playground'); 
        }else{
            return view('index');
        }
        
})->name('index');

Route::get('/playground', [ModelsController::class, 'index'])->name('home');

Route::get('/get-base-models',[ModelsController::class, 'getBaseModels'])->name('getbasemodels');
Route::get('/get-schedulers',[ModelsController::class, 'getSchedulers'])->name('getschedulers');
Route::post('/generate-images',[ModelsController::class, 'generateImages'])->name('generateImages');
Route::post('/get-superResolution',[ModelsController::class, 'getSuperResolutionImage'])->name('getSuperResolutionImage');
Route::post('/save-superResolution',[ModelsController::class, 'saveSuperResolutionImage'])->name('saveSuperResolutionImage');
Route::post('/restart',[ModelsController::class, 'restartServer'])->name('restart');

Route::post('/sendInvite',[InvitationController::class, 'sendInvite'])->name('sendInvite');
Route::post('/signUp',[UserController::class, 'signUp'])->name('signUp');






