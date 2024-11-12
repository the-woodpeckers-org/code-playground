<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Application extends Model
{
 //	id 	user_id job_id 	cv_id 	applied_at 	created_at 	updated_at 	
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id',
        'applied_at',
        'cv_id',
        'status',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job()
    {
        return $this->belongsTo(JobRecruitment::class);
    }
    
}
