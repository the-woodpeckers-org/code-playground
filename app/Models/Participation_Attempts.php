<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation_Attempts extends Model
{
    use HasFactory;

    protected $table = 'participation_attempts';
    protected $fillable = [
        'participation_id',
        'problem_id',
        'attempt_count',
        'code',
        'passed_at',
        'deleted_at'
    ];

    public function participation() {
        return $this->belongsTo(Participation::class, 'id', 'participation_id');
    }

    public function problem() {
        return $this->belongsTo(Problem::class, 'id', 'problem_id');
    }
}
