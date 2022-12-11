<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\sessionChecker;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [HomeController::class, 'login']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/teacher-login', [HomeController::class, 'teacherLogin']);
Route::post('/teacher-login', [HomeController::class, 'teacherLogin']);

Route::middleware([sessionChecker::class])->group(function(){

    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/section', [HomeController::class, 'section']);

    Route::get('/getSections', [HomeController::class, 'sectionList']);
    Route::post('/getSections', [HomeController::class, 'sectionList']);

    Route::get('/getStudentAttendance', [HomeController::class, 'getStudentAttendance']);
    Route::post('/getStudentAttendance', [HomeController::class, 'getStudentAttendance']);

    Route::get('/editAttendance', [HomeController::class, 'editAttendance']);
    Route::post('/editAttendance', [HomeController::class, 'editAttendance']);

    Route::get('/searchStudents', [HomeController::class, 'searchStudents']);
    Route::post('/searchStudents', [HomeController::class, 'searchStudents']);

    Route::get('/enrollStudent', [HomeController::class, 'enrollStudent']);
    Route::post('/enrollStudent', [HomeController::class, 'enrollStudent']);

    Route::get('/removeStudent', [HomeController::class, 'removeStudent']);
    Route::post('/removeStudent', [HomeController::class, 'removeStudent']);

    Route::get('/generate-qrcode', [QrCodeController::class, 'index']);
    Route::post('/generate-qrcode', [QrCodeController::class, 'index']);

    Route::get('/getQR', [QrCodeController::class, 'getQR']);
    Route::post('/getQR', [QrCodeController::class, 'getQR']);

});

Route::get('/giveAttendance', [QrCodeController::class, 'giveAttendance']);
Route::post('/giveAttendance', [QrCodeController::class, 'giveAttendance']);



