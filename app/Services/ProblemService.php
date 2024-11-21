<?php

namespace App\Services;

use App\Http\Requests\SubmitCodeFormRequest;
use App\Http\Requests\SubmitCodeParticipationFormRequest;
use App\Models\Attempt;
use App\Models\CategoryStat;
use App\Models\LanguageStat;
use App\Models\Participation_Attempts;
use App\Models\Problem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProblemService
{
    public function getAll(Request $request)
    {
        $result = Problem::query();
        $result->select();
        $result->where('contest_id', '=', null);
        $result->addSelect(['problems.*']);
        return $result->paginate(16);
    }

    public function get(Request $request)
    {
        $result = Problem::query();
        $result->where('id', $request['id']);

        return $result->first();
    }

    public function getAllProblemsByContributor(Request $request)
    {
        $contributor = User::find($request->user()->id);
        return Problem::where('created_by', $contributor->id)->paginate(8);
    }

    public function getAllU(Request $request)
    {
        $result = Problem::query();
        $result->select();
        $result->where('contest_id', '=', null);
        if ($request->user()) {
            $userId = $request->user()->id;
            $result->leftJoin('attempts', function ($query) use ($userId) {
                $query->on('attempts.problem_id', '=', 'problems.id')
                    ->where('attempts.user_id', $userId);
            });
            $result->addSelect(['attempts.id as attempt_id', 'attempts.code as code', 'attempts.passed_at as passed_at']);
        }
        $result->addSelect(['problems.*']);
        return $result->paginate(16);
    }

    public function getU(Request $request)
    {
        $result = Problem::query();
        $result->where('problems.id', $request['id']);
        if (auth('sanctum')->check()) {
            $userId = auth('sanctum')->user()->id;
            $result->leftJoin('attempts', function ($query) use ($userId) {
                $query->on('attempts.problem_id', '=', 'problems.id')
                    ->where('attempts.user_id', $userId);
            });
            $result->addSelect(['attempts.id as attempt_id', 'attempts.code as code', 'attempts.passed_at as passed_at']);
        }
        $result->addSelect(['problems.*']);
        return $result->first();
    }

    public function getParticipationProblem(Request $request)
    {
        $result = Problem::query();
        $result->where('problems.contest_id', '!=', null);
        $result->where('problems.id', '=' ,$request->input('id'));
        $participation_id = $request->input('participation_id');
        $result->leftJoin('participation_attempts', function ($query) use ($participation_id) {
            $query->on('participation_attempts.problem_id', '=', 'problems.id')
                ->where('participation_attempts.participation_id', $participation_id);
        });
        $result->addSelect(['participation_attempts.id as participation_attempt_id', 'participation_attempts.code as code', 'participation_attempts.passed_at as passed_at']);
        $result->addSelect(['problems.*']);
        return $result->first();
    }

    public function submitProblem(SubmitCodeFormRequest $request)
    {
        if ($request->user()) {
            $userId = $request->user()->id;
            $attempt = Attempt::where('problem_id', $request->input('problem_id'))->where('user_id', $userId)->first();
            if ($attempt == null) {
                $attempt = new Attempt();
                $attempt->user_id = $userId;
                $attempt->problem_id = $request->input('problem_id');
            }
            // if only the first time pass the problem
            if ($attempt->passed_at === null) {
                $attempt->passed_at = Carbon::now();
                $problem = Problem::where('id', $request->input('problem_id'))->first();
                // insert or update user category stats
                foreach ($problem->getCategoriesAttribute() as $category) {
                    $categoryStat = CategoryStat::where('category_id', $category->id)->where('user_id', $userId)->first();
                    if ($categoryStat == null) {
                        $categoryStat = new CategoryStat();
                        $categoryStat->user_id = $userId;
                        $categoryStat->category_id = $category->id;
                        $categoryStat->save();
                    }
                    $categoryStat->update([
                        'attempt_count' => $categoryStat->attempt_count + 1
                    ]);
                }
                // insert or update user language stats
                $languageStat = LanguageStat::where('language_id', $request->input('language_id'))->where('user_id', $userId)->first();
                if ($languageStat == null) {
                    $languageStat = new LanguageStat();
                    $languageStat->user_id = $userId;
                    $languageStat->language_id = $request->input('language_id');
                    $languageStat->save();
                }
                $languageStat->update([
                    'attempt_count' => $languageStat->attempt_count + 1
                ]);
            }
            $attempt->code = $request->input('code');
            $attempt->save();



            return response()->json(['message' => 'Problem submitted!']);
        }
        return new BadRequestHttpException('Unauthenticated');
    }

    public function submitParticipationProblem(SubmitCodeParticipationFormRequest $request)
    {
        if ($request->user()) {
            $userId = $request->user()->id;
            $attempt = Participation_Attempts::where('problem_id', $request->input('problem_id'))->where('participation_id', $request->input('participation_id'))->first();
            if ($attempt == null) {
                $attempt = new Participation_Attempts();
                $attempt->participation_id = $userId;
                $attempt->problem_id = $request->input('problem_id');
            }
            if ($attempt->passed_at === null) {
                $attempt->passed_at = Carbon::now();
            }
            $attempt->code = $request->input('code');
            $attempt->save();
            return response()->json(['message' => 'Problem submitted!']);
        }
        return new BadRequestHttpException('Unauthenticated');
    }
}
