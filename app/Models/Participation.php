<?php

namespace App\Models;

use Carbon\Carbon;
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
        'contest',
        'user',
        'finishedTime'
    ];

    public function getProblemsAttribute()
    {
        return Contest::where('id', $this->contest_id)->first()->problems()->get();
    }

    public function getContestAttribute()
    {
        return Contest::where('id', $this->contest_id)->first();
    }

    public function getUserAttribute()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getFinishedTimeAttribute() {
        if ($this->finished_at) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->started_at);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->finished_at);

            $diff = $from->diff($to);
            return [
                'days' => $diff->d,
                'hours' => $diff->h,
                'minutes' => $diff->i,
                'seconds' => $diff->s
            ];
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function attempts()
    {
        return $this->hasMany(Participation_Attempts::class, 'participation_id', 'id');
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }
}
