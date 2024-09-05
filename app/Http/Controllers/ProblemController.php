<?php

namespace App\Http\Controllers;

use App\Services\ProblemService;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    private ProblemService $service;

    public function __construct(ProblemService $service)
    {
        $this->service = $service;
    }

    public function problems()
    {
        return view('home.problem_list');
    }

    public function getProblems(Request $request)
    {
        return response()->json($this->service->getProblems());
    }

    public function getProblem(Request $request)
    {
        return response()->json($this->service->getProblem($request['id']));
    }
}
