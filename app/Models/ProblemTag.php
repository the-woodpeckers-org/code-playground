<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'problem_id',
        'category_id'
    ];
    protected $table = 'problem_tags';
}
