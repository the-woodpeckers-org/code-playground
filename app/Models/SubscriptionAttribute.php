<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
class SubscriptionAttribute extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'subscription_name',
        'start_date',
        'order_id',
        'end_date',
    ];
    /**
     * Get the user that owns the profile_user.
     */

    public function scopeActive(Builder $query)
    {
        return $query->where('end_date', '>', Carbon::now());
    }
}
