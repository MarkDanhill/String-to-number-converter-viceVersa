<?php

use App\Http\Controllers\ConverterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/convertNumber', [ConverterController::class, 'convertStringToDigits']);
Route::post('/convertString', [ConverterController::class, 'convertDigitsToString']);
Route::get('/toUsdConverter', [ConverterController::class, 'convertPhpToUsd']);
Route::post('/convert', [ConverterController::class, 'convert']);
