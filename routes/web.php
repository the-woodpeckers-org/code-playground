<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Route;

Route::get('/problem/{id}', [HomeController::class, 'problem'])->name('home.problem');
Route::post('/compile', [HomeController::class, 'compileCode'])->name('home.compile');
Route::get('/problems', [ProblemController::class, 'problems'])->name('problem.problems');
Route::get('/getProblems', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/getProblem/{id}', [ProblemController::class, 'getProblem'])->name('problem.getProblem');
