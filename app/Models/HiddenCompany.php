<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class HiddenCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_user_id',
        'profile_company_id',
        
    ];
    
    
}
