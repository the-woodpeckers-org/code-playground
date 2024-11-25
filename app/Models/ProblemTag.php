<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemTag extends Model
{
    protected $fillable = [
        'problem_id',
        'category_id'
    ];
    use HasFactory;
}
