<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Application;
use App\Models\JobRecruitment;
use App\Utils\Constants\Status;
use Carbon\Carbon;

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
        'status',
        'avatar_url',
        'email_verified_at',
        'requested_to_contributor',
    ];
    protected $appends = [
        'profileUser',
        'Cv',
        'Order',
        'IsRemind',
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
        return $this->hasOne(ProfileCompany::class);
    }

    public function getCreatedProblems()
    {
        return $this->hasMany(Problem::class, 'created_by', 'id');
    }

    public function getProfileUserAttribute()
    {
        return ProfileUser::where('user_id', $this->id)->first();
    }

    public function getCvAttribute()
    {
        return Cv::where('user_id', $this->id)->where('isPrimary', '=', 1)->first();
    }

    public function getOrderAttribute()
    {
        return Order::where('user_id', $this->id)->where('status','=',Status::PAID)->get();
    }

    // Kiểm tra xem công ty này đã từng đăng ký dịch vụ premium chưa
    // để thực hiện việc nhắc nhở đăng ký gia hạn
    // Nếu có ít nhất 1 đơn hàng nào đó đã từng đăng ký dịch vụ premium
    // và còn hạn sử dụng ít hơn 5 ngày so với thời điểm hiện tại
    // thì trả về true, ngược lại trả về false
    public function getIsRemindAttribute()
    {
        $orders = Order::where('user_id', $this->id)->get();
        if ($orders->isEmpty()) {
            return false;
        } else {
            foreach ($orders as $order) {
                $subscription = SubscriptionAttribute::where('order_id', $order->id)
                    ->where('end_date', '>', Carbon::now())
                    ->first();
                if ($subscription) {
                    $daysRemaining = Carbon::now()->diffInDays($subscription->end_date);
                    if ($daysRemaining <= 5 && $daysRemaining > 0) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
