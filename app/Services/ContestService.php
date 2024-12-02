<?php

namespace App\Services;

use App\Http\Requests\CreateContestFormRequest;
use App\Http\Requests\EditContestFormRequest;
use App\Models\Contest;
use App\Models\Language;
use App\Models\Problem;
use App\Models\ProblemLanguage;
use App\Models\ProblemTag;
use App\Models\Testcase;
use Illuminate\Http\Request;
use App\Utils\Constants\Status;
use Illuminate\Support\Carbon;

class ContestService
{
    public function getAll(Request $request)
    {
        return Contest::paginate(8);
    }

    public function getById(Request $request)
    {
        return Contest::where("id", $request->id)->first();
    }

    public function getForLanding()
    {
        return Contest::orderBy("created_at", "desc")->where('status', '=', Status::APPROVED)->where('end_date','>', Carbon::now())->limit(3)->get();
    }

    public function getAllByContributor(Request $request)
    {
        return Contest::where('created_by', $request->user()->id)->paginate(8);
    }

    public function getContestForManage(Request $request)
    {
        $contests = Contest::where('created_by', $request->user()->id)->paginate(8);
        $detailContests = [];
        foreach ($contests as $contest) {
            $detailContest = [
                'id' => $contest->id,
                'title' => $contest->title,
                'description' => $contest->description,
                'problems' => $contest->problems,
                'start_date' => $contest->start_date,
                'end_date' => $contest->end_date,
                'status' => $contest->status,
                'created_by' => $contest->user,
                'created_at' => $contest->created_at,
                'imgUrl' => $contest->imgUrl,
                'participation' => $contest->participation,
                'change_required' => $contest->change_required,
            ];
            array_push($detailContests, $detailContest);
        }
        return response()->json(
            [
                'contests' => $contests,
                'detailContests' => $detailContests,
                'total' => $contests->total(),
            ]
        );

    }

    public function createContest(CreateContestFormRequest $request)
    {
        $data = $request->all();
        $contest = new Contest();
        $tags = '';
        foreach ($request->input('tags') as $tag) {
            $tags .= $tag . ',';
        }
        $contest->fill([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'tags' => $tags,
            'status' => Status::PENDING,
            'created_by' => $request->user()->id,
        ]);
        $contest->save();
        foreach ($data['problems'] as $problem) {
            $new_problem = new Problem();
            $new_problem->fill([
                'title' => $problem['title'],
                'description' => $problem['description'],
                'difficulty' => $problem['difficulty'],
                'acceptance_rate' => 0,
                'contest_id' => $contest->id,
                'created_by' => $request->user()->id
            ]);
            $new_problem->save();
            foreach ($problem['languages'] as $language) {
                $slanguage = Language::where('name', $language)->first();
                $p_tag = new ProblemLanguage();
                $p_tag->fill([
                    'problem_id' => $new_problem->id,
                    'language_id' => $slanguage->id,
                ]);
                $p_tag->save();
            }
            foreach ($problem['testcases'] as $testcase) {
                $new_testcase = new Testcase();
                $new_testcase->fill([
                    'problem_id' => $new_problem->id,
                    'stdin' => $testcase['stdin'],
                    'expected_output' => $testcase['expected_result'],
                ]);
                $new_testcase->save();
            }
        }
        return ['message' => 'success', 'data' => $request->input('problems')];
    }

    public function editContest(EditContestFormRequest $request)
    {

    }

    public function deleteContest(Request $request)
    {

    }

    public function getContestByContributor(Request $request)
    {
        return Contest::where('id', $request->input('id'))
            ->with('problems')->first();
    }

}
