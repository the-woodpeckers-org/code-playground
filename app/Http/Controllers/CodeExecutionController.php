<?php

namespace App\Http\Controllers;

use App\Services\CodeExecutionService;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CodeExecutionController extends Controller
{

    private CodeExecutionService $service;

    public function __construct(CodeExecutionService $service)
    {
        $this->service = $service;
    }

    public function problem($id)
    {
        $problem_id = $id;
        return view('home.problem', compact('problem_id'));
    }

    public function compileCode(Request $request)
    {
        $language = $request['language'];
        $code = $request->input("code");
        $input = $request->input("input");
        return $this->service->execute($language, $code, $input, 1);
    }
}
