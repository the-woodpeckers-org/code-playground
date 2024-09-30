<?php

namespace App\Services;

use App\Http\Requests\SubmitCodeFormRequest;
use App\Models\Attempt;
use App\Models\Problem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProblemService
{
    public static function getAll()
    {
        $result = Problem::query();
        $result->select();
        $result->where('contest_id', '=', null);
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $result->leftJoin('attempts', function ($query) use ($userId) {
                $query->on('attempts.problem_id', '=', 'problems.id')
                    ->where('attempts.user_id', $userId);
            });
            $result->addSelect(['attempts.id as attempt_id', 'attempts.code as code', 'attempts.passed_at as passed_at']);
        }
        $result->addSelect(['problems.*']);
        return $result->paginate(16);
    }

    public static function get($id)
    {
        $result = Problem::query();
        $result->where('id', $id);
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $result->with('attempts')->whereHas('attempts', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }
        return $result->first();
    }

    public static function getWithTestcases($id)
    {
        $result = Problem::query();
        $result->where('problems.id', $id);
        $result->with('testcases');
        $result->select();
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $result->leftJoin('attempts', function ($query) use ($userId) {
                $query->on('attempts.problem_id', '=', 'problems.id')
                    ->where('attempts.user_id', $userId);
            });
            $result->addSelect(['attempts.id as attempt_id', 'attempts.code as code', 'attempts.passed_at as passed_at']);
        }
        $result->addSelect(['problems.*']);
        return $result->first();
    }

    public static function getBySearch($searchString)
    {
        return Problem::where('title', 'like', '%' . $searchString . '%')->paginate(16);
    }

    public static function submitProblem(SubmitCodeFormRequest $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $attempt = Attempt::where('problem_id', $request->input('problem_id'))->where('user_id', $userId)->first();
            if ($attempt == null) {
                $attempt = new Attempt();
                $attempt->user_id = $userId;
                $attempt->problem_id = $request->input('problem_id');
            }
            if ($attempt->passed_at === null) {
                $attempt->passed_at = Carbon::now();
            }
            $attempt->code = $request->input('code');
            $attempt->save();
            return response()->json(['message' => 'Problem submitted!']);
        }
        return new BadRequestHttpException('Check your authentication!');
    }
}
