<?php

namespace App\Repositories;

use App\Models\Testcase;

class TestcaseRepository
{
    public function add(Testcase $obj)
    {

    }

    public function update(Testcase $obj)
    {

    }

    public function delete($id)
    {

    }

    public function getAll()
    {
        return Testcase::paginate(16);
    }

    public function get($id)
    {
        return Testcase::where('id', $id)->first();
    }

    public function getByProblemId($id)
    {
        return Testcase::where('problem_id', $id)->get();
    }
}
