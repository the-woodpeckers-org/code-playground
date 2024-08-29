<?php

namespace App\Services;

use App\Repository\ProblemRepository;

class ProblemService
{
    public function getProblems() {
        $problems = ProblemRepository::getAll();
        return $problems;
    }
}
