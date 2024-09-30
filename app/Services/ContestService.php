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

    public function getForLanding() {
        return Contest::orderBy("created_at", "desc")->limit(3)->get();
    }
}
