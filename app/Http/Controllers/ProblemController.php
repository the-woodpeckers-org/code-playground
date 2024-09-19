<?php

namespace App\Http\Controllers;

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
        return response()->json($this->service->getProblems());
    }

    public function getProblem(Request $request)
    {
        $result = $this->service->getProblem($request['id']);
        if ($result == null) {
            throw NotFoundHttpException('Problem not found!');
        }
        return response()->json(['problem' => $this->service->getProblem($request['id'])]);
    }
}
