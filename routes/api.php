<?php

use App\Http\Controllers\Api\Admin\Parameter\BidangController;
use App\Http\Controllers\Api\Admin\Parameter\DesaController;
use App\Http\Controllers\Api\Admin\Parameter\KecamatanController;
use App\Http\Controllers\Api\Admin\Parameter\KegiatanController;
use App\Http\Controllers\Api\Admin\Parameter\PemdaController;
use App\Http\Controllers\Api\Admin\Parameter\SubbidangController;
use App\Http\Controllers\Api\Admin\Parameter\SumberdanaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);

    Route::prefix('admin')->group(function () {
        Route::prefix('parameter')->group(function () {
            Route::prefix('pemda')->group(function () {
                Route::get('', [PemdaController::class, 'index']);
                Route::post('save', [PemdaController::class, 'save']);
            });
            Route::prefix('kecamatan/{kdProv}/{kdKab}')->group(function () {
                Route::get('', [KecamatanController::class, 'index']);
                Route::post('save', [KecamatanController::class, 'save']);
                Route::delete('remove/{kdKec}', [KecamatanController::class, 'remove']);
            });
            Route::prefix('desa/{kdProv}/{kdKab}/{kdKec}')->group(function () {
                Route::get('', [DesaController::class, 'index']);
                Route::post('save', [DesaController::class, 'save']);
                Route::delete('remove/{kdDesa}', [DesaController::class, 'remove']);
            });
            Route::prefix('bidang')->group(function () {
                Route::get('', [BidangController::class, 'index']);
                Route::post('save', [BidangController::class, 'save']);
                Route::delete('remove/{kdBidang}', [BidangController::class, 'remove']);
            });
            Route::prefix('subbidang/{kdBidang}')->group(function () {
                Route::get('', [SubbidangController::class, 'index']);
                Route::post('save', [SubbidangController::class, 'save']);
                Route::delete('remove/{kdSubBidang}', [SubbidangController::class, 'remove']);
            });
            Route::prefix('kegiatan/{kdBidang}/{kdSubbidang}')->group(function () {
                Route::get('', [KegiatanController::class, 'index']);
                Route::post('save', [KegiatanController::class, 'save']);
                Route::delete('remove/{kdKegiatan}', [KegiatanController::class, 'remove']);
            });
            Route::prefix('sumberdana')->group(function () {
                Route::get('', [SumberdanaController::class, 'index']);
                Route::post('save', [SumberdanaController::class, 'save']);
                Route::delete('remove/{kode}', [SumberdanaController::class, 'remove']);
            });
        });
    });
});
