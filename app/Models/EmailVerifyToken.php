<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerifyToken extends Model
{
    protected $fillable = [
        'email',
        'token',
        'expires_at'
    ];
    use HasFactory;
}
