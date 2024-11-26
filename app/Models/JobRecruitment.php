<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Get the user that owns the JobRecruitment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
