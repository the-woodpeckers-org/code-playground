<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Route;

Route::view('/{any}', 'layout.app')
    ->where('any', '^(?!api).*$');

Route::get('/api/problem/{id}', [HomeController::class, 'problem'])->name('home.problem');
Route::post('/api/compile', [HomeController::class, 'compileCode'])->name('home.compile');
Route::get('/api/problems', [ProblemController::class, 'problems'])->name('problem.problems');
Route::get('/api/getProblems', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/api/getProblem/{id}', [ProblemController::class, 'getProblem'])->name('problem.getProblem');

Route::post('/api/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/api/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/api/logout', [AuthController::class, 'logout'])->name('auth.logout');
