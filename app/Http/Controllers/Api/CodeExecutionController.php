<?php

namespace App\Http\Controllers\Api;

use App\Services\CodeExecutionService;
use Illuminate\Http\Request;

class CodeExecutionController
{

    private CodeExecutionService $service;

    public function __construct(CodeExecutionService $service)
    {
        $this->service = $service;
    }
    public function compileCode(Request $request)
    {
        $language = $request['language'];
        $code = $request->input("code");
        $input = $request->input("input");
        $problem_id = $request->input("problem_id");
        return $this->service->execute($language, $code, $input, $problem_id);
    }
}
