<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'total'];

    protected $appends = [
        'Subscription',
    ];

    public function getSubscriptionAttribute()
    {
        return $this->hasOne(SubscriptionAttribute::class, 'order_id', 'id')->where('end_date', '<', now());
    }
}
