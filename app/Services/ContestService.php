<?php

namespace App\Services;

use App\Models\Contest;

class ContestService
{
    public function getAll()
    {

    }

    public function getById($id) {
        return Contest::where("id", $id)->first();
    }
}
