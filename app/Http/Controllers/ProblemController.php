<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitCodeFormRequest;
use App\Responses\APIResponse;
use App\Services\ProblemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProblemController extends Controller
{
    private ProblemService $service;

    public function __construct(ProblemService $service)
    {
        $this->service = $service;
    }

    public function getProblems(Request $request)
    {
        return response()->json($this->service->getAll());
    }

    public function getProblem(Request $request)
    {
        $result = $this->service->getWithTestcases($request['id']);
        if ($result == null) {
            throw new NotFoundHttpException('Problem not found!');
        }
        return response()->json(['problem' => $result]);
    }

    public function submit(SubmitCodeFormRequest $request)
    {
        return $this->service->submitProblem($request);
    }
}
