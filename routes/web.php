<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\CodeExecutionController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ContestController;
use Illuminate\Support\Facades\Route;

Route::view('/{any}', 'layout.app')
    ->where('any', '^(?!api).*$');

Route::post('/api/compile', [CodeExecutionController::class, 'compileCode'])->name('code_execution.compile');

Route::get('/api/getProblems', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/api/getProblem/{id}', [ProblemController::class, 'getProblem'])->name('problem.getProblem');

Route::post('/api/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/api/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/api/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/api/submit', [ProblemController::class, 'submit'])->name('problem.submit');

Route::get('/api/contest/{id}', [ContestController::class, 'get'])->name('contest.get');
