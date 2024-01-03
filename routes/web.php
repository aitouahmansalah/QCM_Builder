<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

Route::middleware(['admin'])->get('/exams/create', [ExamController::class, 'create'])->name('exams.create');

Route::middleware(['admin'])->post('/exams/store', [ExamController::class, 'store'])->name('exams.store');

Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');

Route::get('/exams/show/{exam}', [ExamController::class, 'show'])->name('exams.show');

Route::middleware(['admin'])->get('/exams/publish/{exam}', [ExamController::class, 'publish'])->name('exams.publish');

Route::middleware(['admin'])->get('/exams/delete/{exam}', [ExamController::class, 'publish'])->name('exams.delete');

Route::get('/exams/pass/{exam}', [ExamController::class, 'pass'])->name('exams.pass');

Route::post('/exams/pass/{exam}', [ExamController::class, 'submit'])->name('exams.submit');

Route::get('/exams/result', [ExamController::class, 'result'])->name('exams.result');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthController::class, 'loginform'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');


