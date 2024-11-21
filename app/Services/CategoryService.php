<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function getAllCategories(Request $request)
    {
        return Category::all();
    }
}
