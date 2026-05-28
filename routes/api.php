<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\AdminController;


Route::post('/login', [ExamController::class, 'login']);
Route::post('/sync-session', [ExamController::class, 'syncSession']);
Route::get('/questions', [ExamController::class, 'getQuestions']);
Route::post('/submit', [ExamController::class, 'submitExam']);

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/dashboard', [AdminController::class, 'getDashboardData']);
    Route::post('/update-setings', [AdminController::class, 'updateSettings']);
    Route::post('/leaderboard/{subject}/{class}', [AdminController::class, 'getLeaderboard']);
});