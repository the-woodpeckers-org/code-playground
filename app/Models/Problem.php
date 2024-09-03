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
      'deleted_at'
    ];

    public function Testcases() {
        return $this->hasMany(Testcase::class, 'problem_id', 'id');
    }

}
