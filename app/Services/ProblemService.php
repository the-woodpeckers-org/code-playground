<?php

namespace App\Services;

use App\Repositories\ProblemRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProblemService
{
    public function getProblems() {
        return ProblemRepository::getAll();
    }

    public function getProblem($id) {
        return ProblemRepository::getWithTestcases($id);
    }
}
