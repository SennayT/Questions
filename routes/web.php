<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\AcceptAnswerController;

Route::get('/', function () {
    return redirect('/questions');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/questions',QuestionsController::class)->except('show');


Route::resource('questions.answers',AnswersController::class)->only(['store','edit','update','destroy']);
//Route::resource('questions.answers',AnswersController::class)->except(['index','create','show']);

Route::get('/questions/{slug}',[QuestionsController::class,'show'])->name('questions.show'); // So slug can be used instead of id
Route::post('/answers/{answer}/accept',[AcceptAnswerController::class,'accept'])->name('answers.accept');
