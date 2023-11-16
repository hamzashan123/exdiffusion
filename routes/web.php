<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\ModelsController;
use App\Http\Controllers\Backend\InvitationController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ModelResetController;
use App\Http\Controllers\Frontend\PublicModelsController;
use App\Http\Controllers\Frontend\PublishCreationController;
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
Route::get('/publish-creation', [PublicModelsController::class, 'publishCreation'])->name('publishcreation');
Route::get('/my-asset', [PublishCreationController::class, 'myAsset'])->name('myasset');
Route::get('/image-detail/{id?}', [PublishCreationController::class, 'imageDetail'])->name('imageDetail');
Route::get('/image-detail-delete/{id?}', [PublishCreationController::class, 'deleteImageDetail'])->name('deleteImageItem');
Route::post('/creative-history',[PublicModelsController::class, 'creativeHistory'])->name('creativeHistory');
Route::post('/user-creative-history', [PublicModelsController::class, 'getUserCreativeHistory'])->name('UserCreativeHistory');
Route::post('/delete-userCreativeHistory', [PublicModelsController::class, 'deleteUserCreativeHistory'])->name('DeleteCreativeHistory');
Route::post('/addToFavoriteCreativeHistory', [PublicModelsController::class, 'addToFavoriteCreativeHistory'])->name('addToFavoriteCreativeHistory');
Route::post('/getGeneratedImageHistory', [PublicModelsController::class, 'getGeneratedImageHistory'])->name('getGeneratedImageHistory');
Route::post('/get-publish-creation', [PublicModelsController::class, 'getPublishCreation'])->name('getPublishCreation');
Route::post('/publish-images', [PublicModelsController::class, 'publishImages'])->name('publishImages');
Route::post('/publish-image', [PublicModelsController::class, 'publishSingleImage'])->name('publishSingleImage');

Route::get('/get-base-models',[PublicModelsController::class, 'getBaseModels'])->name('getbasemodels');
Route::get('/get-schedulers',[PublicModelsController::class, 'getSchedulers'])->name('getschedulers');
Route::post('/generate-images',[ModelsController::class, 'generateImages'])->name('generateImages');
Route::post('/get-superResolution',[ModelsController::class, 'getSuperResolutionImage'])->name('getSuperResolutionImage');
Route::post('/save-superResolution',[ModelsController::class, 'saveSuperResolutionImage'])->name('saveSuperResolutionImage');
Route::post('/restart',[ModelsController::class, 'restartServer'])->name('restart');
Route::get('/reset-models',[ModelResetController::class, 'resetModels'])->name('reset-models');
Route::post('/upload-model',[ModelsController::class, 'uploadModels'])->name('uploadmodel');

Route::post('/sendInvite',[InvitationController::class, 'sendInvite'])->name('sendInvite');
Route::post('/signUp',[UserController::class, 'signUp'])->name('signUp');






