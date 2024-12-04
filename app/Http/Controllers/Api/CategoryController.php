<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function getAllCategories(Request $request)
    {
        return $this->service->getAllCategories($request);
    }

    public function getProblemTags(Request $request)
    {
        return $this->service->getProblemTags($request);
    }
}
