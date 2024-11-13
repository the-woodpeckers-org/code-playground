<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCompany extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'general_information',
        'address',
        'phone',
        'email',
        'skill',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
