<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_position',
        'experience',
        'social',
        'skill',
        'id_number',
    ];
    /**
     * Get the user that owns the profile_user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
