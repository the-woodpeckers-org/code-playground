<?php

namespace App\Http\Controllers\Api;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
