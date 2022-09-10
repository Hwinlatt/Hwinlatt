<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_code', 'userId', 'orderCatgory', 'orderQty', 'orderColor',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'orderCatgory','id');
    }
}
