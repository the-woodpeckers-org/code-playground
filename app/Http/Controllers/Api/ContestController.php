<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateContestFormRequest;
use App\Http\Requests\EditContestFormRequest;
use App\Services\ContestService;
use Illuminate\Http\Request;

class ContestController
{
    private ContestService $service;

    public function __construct(ContestService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request)
    {
        return response()->json($this->service->getById($request));
    }

    public function getLanding()
    {
        return response()->json($this->service->getForLanding());
    }

    public function getAll(Request $request)
    {
        return response()->json($this->service->getAll($request));
    }

    public function getAllByContributor(Request $request)
    {
        return response()->json($this->service->getAllByContributor($request));
    }

    public function getContestForManage(Request $request)
    {
        return $this->service->getContestForManage($request);
    }

    public function createContest(CreateContestFormRequest $request)
    {
        return $this->service->createContest($request);
    }

    public function editContest(EditContestFormRequest $request)
    {
        return $this->service->editContest($request);
    }

    public function deleteContest(Request $request)
    {
        return $this->service->deleteContest($request);
    }

    public function getContestByContributor(Request $request)
    {
        return $this->service->getContestByContributor($request);
    }
}
