<?php

namespace App\Services;

use App\Http\Requests\CreateProblemFormRequest;
use App\Http\Requests\SubmitCodeFormRequest;
use App\Http\Requests\SubmitCodeParticipationFormRequest;
use App\Http\Requests\UpdateProblemFormRequest;
use App\Models\Attempt;
use App\Models\CategoryStat;
use App\Models\Language;
use App\Models\LanguageStat;
use App\Models\Participation_Attempts;
use App\Models\Problem;
use App\Models\ProblemLanguage;
use App\Models\ProblemTag;
use App\Models\Testcase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProblemService
{
    public function getAll(Request $request)
    {
        $result = Problem::query();
        $result->select();
        $result->where('contest_id', '=', null);
        $result->where('status', 'active');
        $result->orderBy('created_at', 'desc');
        $result->addSelect(['problems.*']);
        return $result->paginate(8);
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
        return Problem::where('created_by', $contributor->id)->where('contest_id', null)->paginate(8);
    }

    public function getAllU(Request $request)
    {
        $result = Problem::query();
        $result->select();
        $result->where('contest_id', '=', null);
        $result->where('status', 'active');

        if ($request->user()) {
            $userId = $request->user()->id;
            $result->leftJoin('attempts', function ($query) use ($userId) {
                $query->on('attempts.problem_id', '=', 'problems.id')
                    ->where('attempts.user_id', $userId);
            });
            $result->addSelect(['attempts.id as attempt_id', 'attempts.code as code', 'attempts.passed_at as passed_at']);
        }
        $result->orderBy('problems.created_at', 'desc');
        $result->addSelect(['problems.*']);
        return $result->paginate(8);
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
        $result->where('problems.id', '=', $request->input('id'));
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
                $attempt->participation_id = $request->input('participation_id');
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

    public function createProblem(CreateProblemFormRequest $request)
    {
        if ($request->user()) {
            $problem = new Problem();
            $problem->fill([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'difficulty' => $request->input('difficulty'),
                'acceptance_rate' => 0,
                'created_by' => $request->user()->id,
                'status' => 'pending',
                'change_required' => ''
            ]);
            $problem->save();
            foreach ($request->input('categories') as $category) {
                if (!empty($category['id'])) {
                    $problemTag = new ProblemTag();
                    $problemTag->fill([
                        'problem_id' => $problem->id,
                        'category_id' => $category['id'],
                    ]);
                    $problemTag->save();
                }
            }
            foreach ($request->input('languages') as $language) {
                $problemLanguage = new ProblemLanguage();
                $problemLanguage->fill([
                    'problem_id' => $problem->id,
                    'language_id' => Language::where('name', $language)->first()->id
                ]);
                $problemLanguage->save();
            }
            foreach ($request->input('testcases') as $testcase) {
                $nTestcase = new Testcase();
                $nTestcase->fill([
                    'problem_id' => $problem->id,
                    'stdin' => $testcase['stdin'],
                    'expected_output' => $testcase['expected_output'],
                ]);
                $nTestcase->save();
            }
            return ['message' => 'Success'];
        }
        return new BadRequestHttpException('Unauthenticated');
    }

    public function updateProblem(UpdateProblemFormRequest $request)
    {
        if ($request->user()) {

            $problem = Problem::where('id', $request->input('id'))->first();
            if ($problem) {
                Testcase::where('problem_id', $request->input('id'))->delete();
                ProblemLanguage::where('problem_id', $request->input('id'))->delete();
                ProblemTag::where('problem_id', $request->input('id'))->delete();
                $problem->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'difficulty' => $request->input('difficulty'),
                ]);
                foreach ($request->input('categories') as $category) {
                    if (!empty($category['id'])) {
                        $problemTag = new ProblemTag();
                        $problemTag->fill([
                            'problem_id' => $problem->id,
                            'category_id' => $category['id'],
                        ]);
                        $problemTag->save();
                    }
                }
                foreach ($request->input('languages') as $language) {
                    $problemLanguage = new ProblemLanguage();
                    $problemLanguage->fill([
                        'problem_id' => $problem->id,
                        'language_id' => Language::where('name', $language)->first()->id
                    ]);
                    $problemLanguage->save();
                }
                foreach ($request->input('testcases') as $testcase) {
                    $nTestcase = new Testcase();
                    $nTestcase->fill([
                        'problem_id' => $problem->id,
                        'stdin' => $testcase['stdin'],
                        'expected_output' => $testcase['expected_output'],
                    ]);
                    $nTestcase->save();
                }
                return ['message' => 'Success'];
            }
            return new NotFoundHttpException('Problem not found');
        }
        return new BadRequestHttpException('Unauthenticated');
    }

    public function deleteProblem(Request $request)
    {
        if ($request->user()) {
            Testcase::where('problem_id', $request->input('id'))->delete();
            ProblemLanguage::where('problem_id', $request->input('id'))->delete();
            ProblemTag::where('problem_id', $request->input('id'))->delete();
            Attempt::where('problem_id', $request->input('id'))->delete();
            Participation_Attempts::where('problem_id', $request->input('id'))->delete();
            Problem::where('id', $request->input('id'))->delete();
            return ['message' => 'Success'];
        }
        return throw new BadRequestHttpException('Unauthenticated');
    }
}
