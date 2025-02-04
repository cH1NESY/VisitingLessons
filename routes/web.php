<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('getRegister');
Route::post('/register', [RegistrationController::class, 'register'])->name('postRegister');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('getLogin');
Route::post('/login', [LoginController::class, 'login'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/addLesson', [LessonController::class, 'getAddLesson'])->name('getAddLesson');
Route::post('/addLesson', [LessonController::class, 'store'])->name('addLesson');

Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::resource('lessons', LessonController::class);

Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('editLesson');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('updateLesson');

Route::post('/start-lesson', 'LessonController@startLesson')->name('start-lesson');

Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login.form');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login');
Route::get('/attendance/success', function() {
    return view('success');
})->name('attendance.success');
