<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use App\Http\Controllers\admin\StudentController;

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
Route::group(['middleware' => ['lang']], function () {
    Route::get('/', [HomeController::class,'index']);
    Route::get('/categories/show/{id}', [CatController::class,'show']);
    Route::get('/skill/show/{id}', [SkillController::class,'show']);
    Route::get('/exam/show/{id}', [ExamController::class,'show']);
    Route::get('/exam/questions/{id}', [ExamController::class,'showQuestions']
    )->middleware(['auth','verified','student']);
    Route::get('/contact', [ContactController::class,'index']);
    Route::post('/contact/send', [ContactController::class,'send']);
    Route::get('/profile', [ProfileController::class,'index']
    )->middleware(['auth','verified','student']);
});
//start exam
Route::post('/exam/start/{id}', [ExamController::class,'start']
)->middleware(['auth','verified','student','can-enter-exam']);
//handel exam
Route::post('/exam/submit/{id}', [ExamController::class,'submit'])->middleware(['auth','verified','student']);
//languages
Route::get('/lang/set/{lang}', [LangController::class,'set']);


//admin
Route::prefix('dashboard')->middleware(['auth','verified','can-enter-dashboard']
    )->group(function (){
    Route::get('/', [AdminHomeController::class,'index']);
// category moduel
    Route::get('/categories', [AdminCatController::class,'index']);
    Route::post('/cat/store', [AdminCatController::class,'store']);
    Route::post('/cat/update', [AdminCatController::class,'update']);
    Route::get('/cat/delete/{cat}', [AdminCatController::class,'delete']);
    Route::get('/cat/toggle/{cat}', [AdminCatController::class,'toggle']);

// skill moduel
    Route::get('/skills', [AdminSkillController::class,'index']);
    Route::post('/skill/store', [AdminSkillController::class,'store']);
    Route::post('/skill/update', [AdminSkillController::class,'update']);
    Route::get('/skill/delete/{skill}', [AdminSkillController::class,'delete']);
    Route::get('/skill/toggle/{skill}', [AdminSkillController::class,'toggle']);

// exam moduel
    Route::get('/exams', [AdminExamController::class,'index']);
    Route::get('/exams/show/{exam}', [AdminExamController::class,'show']);
    Route::get('/exams/show/{exam}/questions', [AdminExamController::class,'showQuestions']);
    Route::get('/exams/create', [AdminExamController::class,'create']);
    Route::get('/exams/create-questions/{exam}', [AdminExamController::class,'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [AdminExamController::class,'storeQuestions']);
    Route::post('/exams/store', [AdminExamController::class,'store']);
    Route::get('/exams/edit/{exam}', [AdminExamController::class,'edit']);
    Route::get('exams/edit-question/{exam}/{question}', [AdminExamController::class,'editQuestion']);
    Route::post('exams/update-question/{exam}/{question}', [AdminExamController::class,'updateQuestion']);
    Route::post('/exams/update/{exam}', [AdminExamController::class,'update']);
    Route::get('/exams/delete/{exam}', [AdminExamController::class,'delete']);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class,'toggle']);

    // exam moduel
    Route::get('/students', [StudentController::class,'index']);
    Route::get('/students/show-score/{user}', [StudentController::class,'showScore']);
    Route::get('/students/open-exam/{user}/{exam}', [StudentController::class,'openExam']);
    // admin moduel
    Route::middleware('superadmin')->group(function(){
    Route::get('/admins', [AdminController::class,'index']);
    Route::get('/students/show-score/{user}', [StudentController::class,'showScore']);
    Route::get('/admins/create', [AdminController::class,'create']);
    Route::post('/admins/store', [AdminController::class,'store']);
    Route::post('/admins/promote/{user}', [AdminController::class,'promote']);
    Route::post('/admins/store', [AdminController::class,'store']);
    });
    //messsage moduel
    Route::get('/messages', [MessageController::class,'index']);
    Route::get('/message/show/{message}', [MessageController::class,'show']);
    Route::post('/messages/response/{message}', [MessageController::class,'responseMail']);
});

