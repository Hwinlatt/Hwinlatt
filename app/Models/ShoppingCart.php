<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $fillable=['userId','cartCatgory','cartQty','cartcolor'];
    public function categories()
    {
        return $this->belongsTo(Category::class,'cartCatgory','id');
    }
}
