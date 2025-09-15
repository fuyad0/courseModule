<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CourseController::class, 'index'])->name('dashboard');;
Route::get('/course', [CourseController::class, 'create']);
Route::post('/course', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/view', [CourseController::class, 'view'])->name('course.view');