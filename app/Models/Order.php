<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    use HasFactory;
    protected $fillable =['order_code'	,
    'user_id',
    'name'	,
    'email'	,
   'phone_one'	,
    'phone_two'	,
    'address'	,
    'country'	,
    'city'	,
    'payment'	,
    'total_price'	,'will_deli_date','received_date','status'];



    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_code', 'order_code');
    }
    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'status','id');
    }
}


