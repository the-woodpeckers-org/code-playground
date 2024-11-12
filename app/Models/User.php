<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Application;
use App\Models\JobRecruitment;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function attempts() {
        return $this->hasMany(Attempt::class, 'user_id', 'id');
    }

    public function getRole() {
        return $this->role;
    }

    public function getResetPasswordToken() {
        return Password_Reset_Tokens::where('email', $this->getEmailForPasswordReset())->first();
    }

    public function getJobApplied() {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function getJobPosted() {
        return $this->hasMany(JobRecruitment::class, 'user_id', 'id');
    }
}
