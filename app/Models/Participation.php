<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $table = 'participation';
    protected $fillable = [
        'user_id',
        'contest_id',
        'finished_problems',
        'started_at',
        'finished_at'
    ];

    protected $appends = [
        'problems',
        'contest'
    ];

    public function getProblemsAttribute()
    {
        return Contest::where('id', $this->contest_id)->first()->problems()->get();
    }

    public function getContestAttribute() {
        return Contest::where('id', $this->contest_id)->first();
    }

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function attempts() {
        return $this->hasMany(Participation_Attempts::class, 'participation_id', 'id');
    }

    public function contest() {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }
}
