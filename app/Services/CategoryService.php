<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ProblemTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryService
{
    public function getAllCategories(Request $request)
    {
        return Category::all();
    }

    public function getProblemTags(Request $request)
    {
    $result = ProblemTag::select('categories.id as category_id', 'categories.name as category_name', DB::raw('count(problem_tags.id) as count'))
        ->join('categories', 'problem_tags.category_id', '=', 'categories.id')
        ->groupBy('categories.id', 'categories.name')
        ->get();

    return response()->json(['data' => $result]);
    }

}
