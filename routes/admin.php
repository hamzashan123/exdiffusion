<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\LinkController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\InvitationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::get('/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('forgot_password');
});

Route::group(['middleware' => ['roles']], function () {
    Route::get('/', [BackendController::class, 'index'])->name('index');
    Route::get('/account-settings', [AdminAuthController::class, 'accountSetting'])->name('account_setting');
    Route::patch('/account-settings', [AdminAuthController::class, 'updateAccount'])->name('account_setting.update');
    Route::get('/supervisors/{supervisor}/remove-image', [SupervisorController::class, 'removeImage'])->name('supervisors.remove_image');
    Route::resource('supervisors', SupervisorController::class);
    Route::resource('users', UserController::class);
    Route::post('/save-user', [UserController::class, 'saveUser'])->name('users.saveUser');

    Route::get('/published-images-reviewed', [BackendController::class, 'showPublishedReviewedImages'])->name('images.published.reviewed');
    Route::get('/published-images-unreviewed', [BackendController::class, 'showPublishedUnReviewedImages'])->name('images.published.unreviewed');

    Route::resource('settings', SettingController::class)->only('index', 'update');
    Route::resource('links', LinkController::class)->except('show');

    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitation.index');
    Route::get('/inviteStatus/{id}/{status?}', [InvitationController::class, 'changeStatus'])->name('inviteStatus');
});
