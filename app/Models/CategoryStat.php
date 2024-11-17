<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryStat extends Model
{
    protected $fillable = [
        'category_id',
        'problem_id',
        'attempt_count'
    ];

    use HasFactory;
}
