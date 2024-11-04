<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile_User extends Model
{
    //
    protected $fillable = [
        'user_id',
        'job_position',
        'experience',
        'social',
        'skill',
    ];
    /**
     * Get the user that owns the profile_user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
