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
        'address',
        'phone_number',
        'gender',
        'birthday',
        'role',
        'avatar_url',
        'email_verified_at'
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

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'user_id', 'id');
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getResetPasswordToken()
    {
        return Password_Reset_Tokens::where('email', $this->getEmailForPasswordReset())->first();
    }

    public function getStatsAttribute()
    {
        return [
            'language_stats' => LanguageStat::where('user_id', $this->id)->join('languages', 'languages.id', '=', 'language_stats.language_id')->get(),
            'category_stats' => CategoryStat::where('user_id', $this->id)->join('categories', 'categories.id', '=', 'category_stats.category_id')->get(),
            ];
    }

    public function getJobApplied()
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function getJobPosted()
    {
        return $this->hasMany(JobRecruitment::class, 'user_id', 'id');
    }

    public function getCVPrimary()
    {
        return $this->hasOne(Cv::class, 'user_id', 'id')->where('isPrimary', '=', 1);
    }
    public function getYourCV()
    {
        return $this->hasMany(Cv::class, 'user_id', 'id');
    }
    public function getCompany()
    {
        return $this->hasOne(ProfileCompany::class, 'user_id', 'id');
    }
    // public function
}
