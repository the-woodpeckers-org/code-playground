<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\CodeExecutionController;
use App\Http\Controllers\Api\ContestController;
use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\api\HiddenCompanyController;
use App\Http\Controllers\Api\ParticipationController;
use App\Http\Controllers\Api\ProblemController;
use App\Http\Controllers\Api\ProfileCompanyController;
use App\Http\Controllers\Api\ProfileUserController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\JobRecruitmentController;
use App\Http\Controllers\Api\ProfileViewHistoryController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('/contest/get', [ContestController::class, 'get'])->name('contest.get');
    Route::get('/problem/u', [ProblemController::class, 'getProblemsU'])->name('problem.getProblemsU');
    Route::get('/problem/get/u', [ProblemController::class, 'getProblemU'])->name('problem.getProblemU');
    Route::get('/participate', [ParticipationController::class, 'participate'])->name('participate.participate');
    Route::get('/participate/problem', [ProblemController::class, 'getParticipationProblem'])->name('problem.getProblemParticipation');
    Route::post('/submit', [ProblemController::class, 'submit'])->name('problem.submit');
    Route::post('/submit/participation', [ProblemController::class, 'submitParticipation'])->name('problem.submitParticipation');
    Route::post('/participate/finish', [ParticipationController::class, 'finish'])->name('participate.finish');
    Route::get('/participate/get', [ParticipationController::class, 'getParticipationU'])->name('participate.getParticipationU');
    Route::post('/saveCV', [CvController::class, 'saveCV'])->name('saveCV');
    Route::get('/cvsU', [CvController::class, 'getCvsU'])->name('getCvsU');
    Route::post('/newCV', [CvController::class, 'newCV'])->name('newCV');
    Route::get('/deleteCV/{id}', [CvController::class, 'deleteCV'])->name('deleteCV');
    Route::get('/getCV/{id}', [CvController::class, 'getCV'])->name('getCV');
    Route::get('/getProfileCV', [ProfileUserController::class, 'getProfileCV'])->name('getProfileCV');
    Route::post('/updateProfileCV', [ProfileUserController::class, 'updateProfileCV'])->name('updateProfileCV');
    Route::post('/setPrimaryCv', [CvController::class, 'setPrimaryCv'])->name('setPrimaryCv');
    Route::post('/setActiveProfile', [ProfileUserController::class, 'setActiveProfile'])->name('setActiveProfile');
    Route::get('/getJobsApplied', [ApplicationController::class, 'getJobsApplied'])->name('getJobsApplied');
    Route::post('/avatar-upload', [UserController::class, 'uploadAvatar'])->name('auth.avatarUpload');
    Route::get('/auth/get', [AuthController::class, 'getAuthenticatedUser'])->name('auth.getAuthenticatedUser');
    Route::post('/updateProfileCompany', [ProfileCompanyController::class, 'updateProfileCompany'])->name('updateProfileCompany');
    Route::get('/getProfileCompanyByUserId', [ProfileCompanyController::class, 'getProfileCompanyByUserId'])->name('getProfileCompanyByUserId');
    Route::get('/getJobsU', [JobRecruitmentController::class, 'getJobsU'])->name('getJobsU');
    Route::post('/createJob', [JobRecruitmentController::class, 'createJob'])->name('createJob');
    Route::get('/getDetailJob/{id}', [JobRecruitmentController::class, 'getDetailJob'])->name('getDetailJob');
    Route::get('/deleteJob/{id}', [JobRecruitmentController::class, 'deleteJob'])->name('deleteJob');
    Route::post('/updateJob', [JobRecruitmentController::class, 'updateJob'])->name('updateJob');
    Route::get('/getCVsApplied/{id}', [JobRecruitmentController::class, 'getCVsApplied'])->name('getCVsApplied');
    Route::post('/applyCV', [ApplicationController::class, 'applyCV'])->name('applyCV');
    Route::get('/getCV_Applied', [ApplicationController::class, 'getCV_Applied'])->name('updateProfileCV');
    Route::get('/isApplied/{id}', [ApplicationController::class, 'isApplied'])->name('isApplied');
    Route::get('/cancelApply/{id}', [ApplicationController::class, 'cancelApply'])->name('cancelApply');
    Route::get('/get-stats', [UserController::class, 'getStats'])->name('getStats');
    Route::get('/get-stats-by-id/{id}', [UserController::class, 'getStatsById'])->name('getStatsById');
    Route::get('/getCompaniesU', [ProfileCompanyController::class, 'getCompaniesU'])->name('getCompaniesU');
    Route::post('/addHiddenCompany', [HiddenCompanyController::class, 'addHiddenCompany'])->name('addHiddenCompany');
    Route::patch('/user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::patch('/auth/verify-email', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
    Route::post('/auth/send-verification-email', [AuthController::class, 'sendVerificationEmail'])->name('sendVerificationEmail');
    Route::post('/removeHiddenCompany', [HiddenCompanyController::class, 'removeHiddenCompany'])->name('removeHiddenCompany');
    Route::post('/addViewHistory', [ProfileViewHistoryController::class, 'addViewHistory'])->name('addViewHistory');
    Route::get('/getListCompanyView', [ProfileViewHistoryController::class, 'getListCompanyView'])->name('getListCompanyView');
    Route::get('/contributor/problems', [ProblemController::class, 'getAllProblemsByContributor'])->name('getAllProblemsByContributor');
});

Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('getAllCategories');

Route::get('/getProfileCompany/{id}', [ProfileCompanyController::class, 'getProfileCompany'])->name('getProfileCompany');
Route::get('/getUserCVToView/{id}', [ProfileUserController::class, 'getUserCVToView'])->name('getUserCVToView');
// Password reset
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.resetPassword');
Route::get('/verify-reset-token', [AuthController::class, 'verifyPasswordResetToken'])->name('auth.verifyToken');

Route::get('/contest/landing', [ContestController::class, 'getLanding'])->name('contest.getLanding');
Route::get('/contest/', [ContestController::class, 'getAll'])->name('contest.getAll');
