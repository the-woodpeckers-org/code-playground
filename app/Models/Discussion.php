<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_by'
    ];

    protected $appends = [
        'user',
    ];

    public function getUserAttribute() {
        return User::where('id', $this->created_by)->first();
    }
}
