<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\CodeExecutionController;
use App\Http\Controllers\Api\ContestController;
use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\api\HiddenCompanyController;
use App\Http\Controllers\Api\ParticipationController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProblemController;
use App\Http\Controllers\Api\ProfileCompanyController;
use App\Http\Controllers\Api\ProfileUserController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\JobRecruitmentController;
use App\Http\Controllers\Api\ProfileViewHistoryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Management\UserMController;
use App\Http\Controllers\Api\Management\JobRecruitmentMController;
use App\Http\Controllers\Api\Management\ProblemMController;
use App\Http\Controllers\Api\Management\ContestMController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\Management\OrderController;
use App\Http\Controllers\Api\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/compile', [CodeExecutionController::class, 'compileCode'])->name('code_execution.compile');

Route::get('/problem', [ProblemController::class, 'getProblems'])->name('problem.getProblems');
Route::get('/problem/get', [ProblemController::class, 'getProblem'])->name('problem.getProblem');
Route::get('/post/slug', [PostController::class, 'getBySlug'])->name('post.getBySlug');
Route::get('/post/landing', [PostController::class, 'getLanding'])->name('post.getLanding');

Route::get('/user/weekly-ranking', [UserController::class, 'getLandingRanking'])->name('user.getLandingRanking');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/registerCompany ', [AuthController::class, 'registerCompany'])->name('auth.registerCompany');


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
    Route::get('/get-stats-by-id', [UserController::class, 'getStatsById'])->name('getStatsById');
    Route::get('/getCompaniesU', [ProfileCompanyController::class, 'getCompaniesU'])->name('getCompaniesU');
    Route::post('/addHiddenCompany', [HiddenCompanyController::class, 'addHiddenCompany'])->name('addHiddenCompany');
    Route::patch('/user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::patch('/auth/verify-email', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
    Route::post('/auth/send-verification-email', [AuthController::class, 'sendVerificationEmail'])->name('sendVerificationEmail');
    Route::post('/removeHiddenCompany', [HiddenCompanyController::class, 'removeHiddenCompany'])->name('removeHiddenCompany');
    Route::post('/addViewHistory', [ProfileViewHistoryController::class, 'addViewHistory'])->name('addViewHistory');
    Route::get('/getListCompanyView', [ProfileViewHistoryController::class, 'getListCompanyView'])->name('getListCompanyView');
    Route::get('/contributor/problems', [ProblemController::class, 'getAllProblemsByContributor'])->name('getAllProblemsByContributor');
    Route::post('/approvedCV', [JobRecruitmentController::class, 'approvedCV'])->name('approvedCV');
    Route::post('/approvedCVUpdate', [JobRecruitmentController::class, 'approvedCVUpdate'])->name('approvedCVUpdate');
    Route::post('/refuseCV', [JobRecruitmentController::class, 'refuseCV'])->name('refuseCV');
    Route::get('/getUserCVToView/{id}', [ProfileUserController::class, 'getUserCVToView'])->name('getUserCVToView');
    Route::get('/getAllUser', [UserMController::class, 'getAllUser'])->name('getAllUser');

    Route::get('/getListSubscribe', [UserMController::class, 'getListSubscribe'])->name('getListSubscribe');
    Route::get('/approvedSubscribe/{id}', [UserMController::class, 'approvedSubscribe'])->name('approvedSubscribe');
    Route::get('/rejectSubscribe/{id}', [UserMController::class, 'rejectSubscribe'])->name('rejectSubscribe');

    Route::get('/getListSubscribeJobRecruitment', [JobRecruitmentMController::class, 'getListSubscribeJobRecruitment'])->name('getListSubscribeJobRecruitment');
    Route::get('/approvedJob/{id}', [JobRecruitmentMController::class, 'approvedJob'])->name('approvedJob');
    Route::get('/rejectJob/{id}', [JobRecruitmentMController::class, 'rejectJob'])->name('rejectJob');
    Route::post('/send-request-change-job', [JobRecruitmentMController::class, 'sendRequestChangeJob'])->name('sendRequestChangeJob');

    Route::get('/getListSubscribeProblem', [ProblemMController::class, 'getListSubscribeProblem'])->name('getListSubscribeProblem');

    //crud problems
    Route::post('/problem', [ProblemController::class, 'createProblem'])->name('createProblem');
    Route::delete('/problem', [ProblemController::class, 'deleteProblem'])->name('deleteProblem');
    Route::put('/problem', [ProblemController::class, 'updateProblem'])->name('updateProblem');

    // user problems
    Route::get('/problem/recently', [ProblemController::class, 'getRecentAttempts'])->name('recentProblem');
    Route::get('/participation/recently', [ParticipationController::class, 'getRecentParticipation'])->name('recentParticipation');

    //crud contributor posts
    Route::post('/post', [PostController::class, 'create'])->name('post.create');
    Route::put('/post', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post', [PostController::class, 'delete'])->name('post.delete');
    Route::get('contributor/post', [PostController::class, 'getAllByContributor'])->name('post.getAllByContributor');

    //crud contributor contests
    Route::get('/contributor/contest/', [ContestController::class, 'getAllByContributor'])->name('contest.getAll');

    Route::get('/auth/get', [AuthController::class, 'getAuthenticatedUser'])->name('auth.getAuthenticatedUser');

    Route::get('/contest/result', [ParticipationController::class, 'getResult'])->name('contest.getResult');

    // problems Management
    Route::post('/ChangeRequestProblem', [ProblemMController::class, 'ChangeRequestProblem'])->name('ChangeRequestProblem');
    Route::post('/RejectProblem', [ProblemMController::class, 'rejectProblem'])->name('rejectProblem');
    Route::post('/ApprovedProblem', [ProblemMController::class, 'ApprovedProblem'])->name('approvedProblem');

    // contest Management system
    Route::get('/getListSubscribeContest', [ContestMController::class, 'getListSubscribeContest'])->name('getListSubscribeContest');
    Route::post('/approvedContest', [ContestMController::class, 'approvedContest'])->name('approvedContest');
    Route::post('/rejectContest', [ContestMController::class, 'rejectContest'])->name('rejectContest');
    Route::post('/changeRequiredContest', [ContestMController::class, 'changeRequiredContest'])->name('changeRequiredContest');


    // contest Management Cruitment
    Route::get('/getContestsU',[ContestController::class, 'getContestForManage'])->name('contest.getContestForManage');
    Route::get('/getParticipantsContestU/{id}',[ParticipationController::class, 'getParticipantsContestU'])->name('contest.getParticipantsContestU');

    // Notification
    Route::get('/getNotification', [NotificationController::class, 'getNotification'])->name('getNotification');
    Route::post('/inviteApply',[NotificationController::class, 'sendInviteApplyNotification'])->name('sendInviteApplyNotification');
    Route::post('/isReadNotification',[NotificationController::class, 'isReadNotification'])->name('isReadNotification');

    Route::post('/contest', [ContestController::class, 'createContest'])->name('contest.create');
    Route::put('/contest', [ContestController::class, 'editContest'])->name('contest.update');
    Route::delete('/contest', [ContestController::class, 'deleteContest'])->name('contest.delete');
    Route::get('/contributor/contest/single', [ContestController::class, 'getContestByContributor'])->name('contest.get');


    // checkout register premium
    Route::get('/orders', [OrderController::class, 'getOrders'])->name('getOrders');
    Route::post('/vnpay_payment',[OrderController::class,'vnpay_payment'])->name('vnpay_payment');
    Route::get('/vnpayReturn',[OrderController::class,'vnpayReturn'])->name('vnpayReturn');
     Route::get('/statistics',[StatisticsController::class, 'statistics'])->name('statistics');

     Route::get('/contestParticipationU',[ContestController::class, 'contestParticipationU'])->name('contestParticipationU');

     Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');

     // authen card id
    Route::post('/verificationCardID', [AuthController::class, 'verificationCardID'])->name('verificationCardID');
});

Route::get('/user/problem/recently', [ProblemController::class, 'getRecentAttemptsById'])->name('recentProblem');
Route::get('/user/participation/recently', [ParticipationController::class, 'getRecentParticipationById'])->name('recentParticipation');
Route::get('/user/guard', [UserController::class, 'getUserGuard'])->name('getUserGuard');
Route::get('/contest/ranking', [ParticipationController::class, 'getResults'])->name('contest.getResults');

Route::get('/categories', [CategoryController::class, 'getAllCategories'])->name('getAllCategories');

Route::get('/getProfileCompany/{id}', [ProfileCompanyController::class, 'getProfileCompany'])->name('getProfileCompany');
// Password reset
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.resetPassword');
Route::get('/verify-reset-token', [AuthController::class, 'verifyPasswordResetToken'])->name('auth.verifyToken');

Route::get('/contest/landing', [ContestController::class, 'getLanding'])->name('contest.getLanding');
Route::get('/contest/', [ContestController::class, 'getAll'])->name('contest.getAll');

Route::get('/listCompanyHiring', [ProfileCompanyController::class, 'listCompanyHiring'])->name('listCompanyHiring');
Route::get('/combinationContest',[ContestController::class, 'combinationContest'])->name('combinationContest');
Route::get('/getProblemTags',[CategoryController::class, 'getProblemTags'])->name('getProblemTags');
Route::get('/problem/search', [ProblemController::class, 'getSearchProblems'])->name('getSearchProblems');
