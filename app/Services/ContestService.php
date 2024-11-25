<?php

namespace App\Services;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestService
{
    public function getAll(Request $request)
    {
        return Contest::paginate(8);
    }

    public function getById(Request $request)
    {
        return Contest::where("id", $request->id)->first();
    }

    public function getForLanding()
    {
        return Contest::orderBy("created_at", "desc")->limit(3)->get();
    }

    public function getAllByContributor(Request $request)
    {
        return Contest::where('created_by', $request->user()->id)->paginate(8);
    }
}
