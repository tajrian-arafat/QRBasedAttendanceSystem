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

Route::get('/adminlogin', [HomeController::class, 'adminlogin']);
Route::get('/adminlogout', [HomeController::class, 'adminlogout']);


Route::get('/login', [HomeController::class, 'login']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/teacher-login', [HomeController::class, 'teacherLogin']);
Route::post('/teacher-login', [HomeController::class, 'teacherLogin']);

Route::get('/admin-login', [HomeController::class, 'adminsLogin']);
Route::post('/admin-login', [HomeController::class, 'adminsLogin']);

Route::get('/giveAttendance', [QrCodeController::class, 'giveAttendance']);
Route::post('/giveAttendance', [QrCodeController::class, 'giveAttendance']);

Route::middleware([sessionChecker::class])->group(function(){

    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/adminhome', [HomeController::class, 'adminhome']);

    Route::get('/addInstructor', [HomeController::class, 'addInstructor']);
    Route::post('/addInstructor', [HomeController::class, 'addInstructor']);

    Route::get('/section', [HomeController::class, 'section']);

    Route::get('/getGroups', [HomeController::class, 'sectionList']);
    Route::post('/getGroups', [HomeController::class, 'sectionList']);

    Route::get('/getAttendeeAttendance', [HomeController::class, 'getAttendeeAttendance']);
    Route::post('/getAttendeeAttendance', [HomeController::class, 'getAttendeeAttendance']);

    Route::get('/editAttendance', [HomeController::class, 'editAttendance']);
    Route::post('/editAttendance', [HomeController::class, 'editAttendance']);

    Route::get('/searchAttendees', [HomeController::class, 'searchAttendees']);
    Route::post('/searchAttendees', [HomeController::class, 'searchAttendees']);

    Route::get('/enrollAttendee', [HomeController::class, 'enrollAttendee']);
    Route::post('/enrollAttendee', [HomeController::class, 'enrollAttendee']);

    Route::get('/removeAttendee', [HomeController::class, 'removeAttendee']);
    Route::post('/removeAttendee', [HomeController::class, 'removeAttendee']);

    Route::get('/generate-qrcode', [QrCodeController::class, 'index']);
    Route::post('/generate-qrcode', [QrCodeController::class, 'index']);

    Route::get('/getQR', [QrCodeController::class, 'getQR']);
    Route::post('/getQR', [QrCodeController::class, 'getQR']);

});





