<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Application;
class Cv extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * Get the user that owns the CV.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function application()
    {
        return $this->hasMany(Application::class, 'cv_id');
    }
    public function getCV_Applied()
    {
        return $this->application()->with('job.user')->get()->pluck('job');
    }

}
