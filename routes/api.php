<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('categories', [CatController::class,'index']);
    Route::get('categories/show/{id}', [CatController::class,'show']);
    Route::get('skills/show/{id}', [SkillController::class,'show']);
    Route::get('exams/show/{id}', [ExamController::class,'show']);
    Route::post('users/register', [AuthController::class,'register']);

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('exams/start/{id}', [ExamController::class,'start']);
        Route::get('exams/show-questions/{id}', [ExamController::class,'showQuestions']);
        Route::post('exams/submit/{id}', [ExamController::class,'submit']);
    });


