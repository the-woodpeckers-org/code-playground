<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_Reset_Tokens extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    public function user() {
        return User::where('email', $this->email)->first();
    }
}
