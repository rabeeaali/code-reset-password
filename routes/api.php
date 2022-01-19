<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CodeCheckController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

 // Password reset routes
Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);

