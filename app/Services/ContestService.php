<?php

namespace App\Services;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestService
{
    public function getAll(Request $request)
    {
        return Contest::paginate(16);
    }

    public function getById($id) {
        return Contest::where("id", $id)->with('problems')->first();
    }

    public function getForLanding() {
        return Contest::orderBy("created_at", "desc")->limit(3)->get();
    }
}
