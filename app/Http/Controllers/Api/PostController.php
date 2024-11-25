<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreatePostFormRequest;
use App\Http\Requests\UpdatePostFormRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request)
    {
        return response()->json($this->service->get($request));
    }

    public function getBySlug(Request $request)
    {
        return response()->json($this->service->getBySlug($request));
    }

    public function getLanding()
    {
        return response()->json($this->service->getLanding());
    }

    public function getAll()
    {
        return response()->json($this->service->getAll());
    }

    public function getAllByContributor(Request $request)
    {
        return response()->json($this->service->getAllByContributor($request));
    }

    public function create(CreatePostFormRequest $request)
    {
        return response()->json($this->service->create($request));
    }

    public function update(UpdatePostFormRequest $request)
    {
        return response()->json($this->service->update($request));
    }

    public function delete(Request $request)
    {
        return response()->json($this->service->delete($request));
    }
}
