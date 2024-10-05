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
    ];

    protected $appends = [
        'remainingTime',
        'isEnded',
        'problems'
    ];

    public function getProblemsAttribute() {
        return Problem::where('contest_id', $this->id)->get();
    }

    public function getIsEndedAttribute() {
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

    public function problems()
    {
        return $this->hasMany(Problem::class, 'contest_id', 'id');
    }
}
