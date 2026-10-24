<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\LiveMapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('dashboard');
});

// راوت الخريطة المباشرة
Route::get('/admin/live-map', [LiveMapController::class, 'index']);

// راوت صفحة إدارة البلاغات المرتبط بقاعدة البيانات (النسخة النهائية الصحيحة)
Route::get('/admin/incidents', [IncidentController::class, 'index'])->name('incidents.index');

Route::get('/admin/fleet', function () {
    return view('fleet');
});

Route::get('/admin/smart-traffic', function () {
    return view('smart-traffic');
});

Route::get('/admin/analytics', function () {
    return view('analytics');
});

Route::get('/admin/settings', function () {
    return view('settings');
});