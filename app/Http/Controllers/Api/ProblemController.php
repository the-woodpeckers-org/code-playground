<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubmitCodeFormRequest;
use App\Services\ProblemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProblemController
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
