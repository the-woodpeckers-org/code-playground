<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/compile', [HomeController::class, 'compileCode'])->name('home.compile');
Route::get('/problems', [ProblemController::class, 'index'])->name('problem.problems');
Route::get('/getProblems', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
