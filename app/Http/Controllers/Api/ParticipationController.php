<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FinishContestFormRequest;
use App\Services\ParticipationService;
use Illuminate\Http\Request;

class ParticipationController
{
    private ParticipationService $service;

    public function __construct(ParticipationService $service)
    {
        $this->service = $service;
    }

    public function participate(Request $request)
    {
        return response()->json($this->service->participate($request));
    }

    public function finish(FinishContestFormRequest $request)
    {
        return response()->json($this->service->finish($request));
    }

    public function getParticipationU(Request $request)
    {
        return response()->json($this->service->getParticipationU($request));
    }

    public function getResult(Request $request)
    {
        return response()->json($this->service->getResult($request));
    }

    public function getResults(Request $request)
    {
        return response()->json($this->service->getResults($request));
    }

    public function getRecentParticipation(Request $request)
    {
        return response()->json($this->service->getRecentParticipation($request));
    }

    public function getRecentParticipationById(Request $request)
    {
        return response()->json($this->service->getRecentParticipationById($request));
    }

    public function getParticipantsContestU($id, Request $request)
    {
        return $this->service->getParticipantsContestU($id, $request);
    }

}
