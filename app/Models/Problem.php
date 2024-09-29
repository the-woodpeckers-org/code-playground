<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Problem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'attempt_count',
        'is_passed',
        'passed_at',
        'deleted_at',
        'contest_id'
    ];

    public function testcases()
    {
        return $this->hasMany(Testcase::class, 'problem_id', 'id');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'problem_id', 'id');
    }

}
