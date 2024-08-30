<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;
use App\Models\Problem;

class ProblemRepository implements BaseRepository
{
    public static function add(Problem $obj)
    {

    }

    public static function update(Problem $obj)
    {

    }

    public static function delete($id)
    {

    }

    public static function getAll()
    {
        return Problem::paginate(16);
    }

    public static function get($id)
    {
        return Problem::where('id', $id)->first();
    }

    public static function getBySearch($searchString)
    {
        return Problem::where('title', 'like', '%' . $searchString . '%')->paginate(16);
    }
}
