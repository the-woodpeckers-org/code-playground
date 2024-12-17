<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'change_required',
        'created_by'
    ];

    protected $appends = [
        'remainingTime',
        'isEnded',
        'participantCount',
        'startTime',
        'problemCount',
        'hostedBy',
        'isStarted'
    ];

    public function getParticipantCountAttribute()
    {
        return Participation::where('contest_id', $this->id)->where('finished_at', '!=', 'null')->count();
    }

    public function getIsStartedAttribute()
    {
        if (Carbon::now() <= $this->start_date) {
            return true;
        }
        return false;
    }

    public function getProblemCountAttribute()
    {
        return Problem::where('contest_id', $this->id)->count();
    }

    public function getHostedByAttribute()
    {
        return User::where('id', $this->created_by)->first()->name;
    }

    public function getIsEndedAttribute()
    {
        if (Carbon::now() > $this->end_date) {
            return true;
        }
        return false;
    }

    public function getRemainingTimeAttribute()
    {
        if (Carbon::now() > $this->end_date) {
            return [
                'days' => 0,
                'hours' => 0,
                'minutes' => 0,
                'seconds' => 0
            ];
        };
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date);

        $diff = $from->diff($to);
        return [
            'days' => $diff->d,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        ];
    }

    public function getStartTimeAttribute()
    {

        if (Carbon::now() > $this->start_date) {
            return [
                'days' => 0,
                'hours' => 0,
                'minutes' => 0,
                'seconds' => 0
            ];
        };
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);

        $diff = $from->diff($to);
        return [
            'days' => $diff->d,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        ];
    }


    public function problems()
    {
        return $this->hasMany(Problem::class, 'contest_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function participation()
    {
        return $this->hasMany(Participation::class, 'contest_id', 'id');
    }
}
