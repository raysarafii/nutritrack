<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AsupanController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\UsdaProxyController;

Route::post('register', [RegisterController::class, 'register']);
Route::get('/dashboard/daily-totals', [AsupanController::class, 'getDailyTotals'])->middleware('auth:sanctum');
Route::get('/usda-proxy', [UsdaProxyController::class, 'proxyUsdaApi']);
