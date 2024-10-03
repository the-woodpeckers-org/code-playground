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
        return response()->json($this->service->getAll($request));
    }

    public function getProblem(Request $request)
    {
        $result = $this->service->get($request);
        if ($result == null) {
            return response(null, 404);
        }
        return response()->json($result);
    }

    public function getProblemsU(Request $request) {
        $result = $this->service->getAllU($request);
        return response()->json($result);
    }

    public function getProblemU(Request $request)
    {
        $result = $this->service->getU($request);
        if ($result == null) {
            return response(null, 404);
        }
        return response()->json($result);
    }

    public function submit(SubmitCodeFormRequest $request)
    {
        return $this->service->submitProblem($request);
    }
}
