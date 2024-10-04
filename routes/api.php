<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CodeExecutionController;
use App\Http\Controllers\Api\ProblemController;
use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\ContestController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/compile', [CodeExecutionController::class, 'compileCode'])->name('code_execution.compile');

Route::get('/problem', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/problem/get', [ProblemController::class, 'getProblem'])->name('problem.getProblem');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/contest/get/{id}', [ContestController::class, 'get'])->name('contest.get');
    Route::get('/contest/{id}/participate', [ContestController::class, 'participate'])->name('contest.participate');
    Route::post('/submit', [ProblemController::class, 'submit'])->name('problem.submit');
    Route::get('/problem/u', [ProblemController::class, 'getProblemsU'])->name('problem.getProblemsU');
    Route::get('/problem/get/u', [ProblemController::class, 'getProblemU'])->name('problem.getProblemU');
    Route::get('/auth/get', [AuthController::class, 'getAuthenticatedUser'])->name('auth.getAuthenticatedUser');
});

Route::get('/contest/landing', [ContestController::class, 'getLanding'])->name('contest.getLanding');
Route::get('/contest/', [ContestController::class, 'getAll'])->name('contest.getAll');
