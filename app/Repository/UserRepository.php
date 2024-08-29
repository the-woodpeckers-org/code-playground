<?php

namespace App\Repository;

use App\Interfaces\BaseRepository;
use App\Models\User;

class UserRepository implements BaseRepository
{
    public function add(User $obj)
    {

    }

    public function update(User $obj)
    {

    }

    public function delete($id)
    {

    }

    public function getAll()
    {
        return User::all()->paginate(16);
    }

    public function get($id)
    {
        return User::where('id', $id)->first();
    }

    public function getBySearch($searchString)
    {
        return User::where('name', 'like', '%' . $searchString . '%')->paginate(16);
    }
}
