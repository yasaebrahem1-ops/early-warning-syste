<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IncidentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// جلب البلاغات لتطبيق الموبايل
Route::get('/incidents', [IncidentApiController::class, 'index']);

// إرسال بلاغ جديد من تطبيق الموبايل للسيستم وغرفة العمليات
Route::post('/incidents', [IncidentApiController::class, 'store']);