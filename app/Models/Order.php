<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
        return SubscriptionAttribute::where('order_id', $this->id)->where('end_date', '>', Carbon::now())->first();
    }


}
