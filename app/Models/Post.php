<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'created_by',
        'thumbnail'
    ];

    protected $appends = [
        'author'
    ];

    public function getAuthorAttribute()
    {
        return User::where('id', $this->created_by)->first()->name;
    }

    use HasFactory;
}
