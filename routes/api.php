<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfilApiController;
use App\Http\Controllers\Api\PelatihApiController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\TarianApiController;
use App\Http\Controllers\Api\GaleriApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::prefix('v1')->group(function () {

    // ── PUBLIC ──────────────────────────────────
    Route::get('/profil',        [ProfilApiController::class,  'index']);
    Route::get('/pelatih',       [PelatihApiController::class, 'index']);
    Route::get('/events',        [EventApiController::class,   'index']);
    Route::get('/events/{id}',   [EventApiController::class,   'show']);
    Route::get('/tarian',        [TarianApiController::class,  'index']);
    Route::get('/tarian/{id}',   [TarianApiController::class,  'show']);
    Route::get('/galeri',        [GaleriApiController::class,  'index']);

    // ── AUTH ─────────────────────────────────────
    Route::post('/auth/login',    [AuthApiController::class, 'login']);
    Route::post('/auth/register', [AuthApiController::class, 'register']);

    // ── PROTECTED ────────────────────────────────
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/me',      [AuthApiController::class, 'me']);
        Route::post('/auth/logout', [AuthApiController::class, 'logout']);
    });
});