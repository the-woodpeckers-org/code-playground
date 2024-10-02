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

Route::get('/getProblems', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/getProblem/{id}', [ProblemController::class, 'getProblem'])->name('problem.getProblem');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/submit', [ProblemController::class, 'submit'])->name('problem.submit');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/contest/get/{id}', [ContestController::class, 'get'])->name('contest.get');
});

Route::get('/contest/landing', [ContestController::class, 'getLanding'])->name('contest.getLanding');
