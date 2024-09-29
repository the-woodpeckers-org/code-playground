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
        'remainingTime'
    ];
    public function getRemainingTimeAttribute()
    {
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

    public function Problems()
    {
        return $this->hasMany(Problem::class, 'contest_id', 'id');
    }
}
