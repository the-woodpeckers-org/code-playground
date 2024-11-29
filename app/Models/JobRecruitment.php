<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class JobRecruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        
        'title',      
        'description',
        'location',     
        'skill', 
        'salary',  
        'negotiable',
        'deadline', 
        'status',
        'position_number',
        'change_required',
        'created_at',     
        'updated_at',    
    ];

    protected $appends = [
        'isEnded',
    ];
    /**
     * Get the user that owns the JobRecruitment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getIsEndedAttribute()
    {
        if (Carbon::now() > $this->deadline) {
            return true;
        }
        return false;
    }
}
