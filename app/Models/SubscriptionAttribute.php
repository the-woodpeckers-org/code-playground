<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionAttribute extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subscription_name',
        'start_date',
        'end_date',
    ];
    /**
     * Get the user that owns the profile_user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
