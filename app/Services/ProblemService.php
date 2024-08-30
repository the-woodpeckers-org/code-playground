<?php

namespace App\Services;

use App\Repositories\ProblemRepository;

class ProblemService
{
    public function getProblems() {
        $problems = ProblemRepository::getAll();
        return $problems;
    }
}
