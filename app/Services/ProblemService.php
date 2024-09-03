<?php

namespace App\Services;

use App\Repositories\ProblemRepository;

class ProblemService
{
    public function getProblems() {
        $problems = ProblemRepository::getAll();
        return $problems;
    }

    public function getProblem($id) {
        $problem = ProblemRepository::getWithTestcases($id);
        return $problem;
    }
}
