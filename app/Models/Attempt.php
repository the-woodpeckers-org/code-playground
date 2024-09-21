<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Attempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'problem_id',
        'user_id',
        'attempt_count',
        'code',
        'passed_at',
        'deleted_at'
    ];

    public function problem() {
        return $this->belongsTo(Problem::class, 'id', 'problem_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
