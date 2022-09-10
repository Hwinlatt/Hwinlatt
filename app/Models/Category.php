<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','type','description','price','price_from','company','qty','populer','available','image'];
    public static function search($key){
        return Category::where('type','like','%'.$key.'%')
                        ->orWhere('name','like','%'.$key.'%')
                        ->orWhere('company','like','%'.$key.'%')
                        ->orWhere('description','like','%'.$key.'%')
                        ->orWhere('tags','like','%'.$key.'%')
                        ->paginate(12);
    }

    public function category_types()
    {
        return CategoryType::orderBy('type_name','ASC')->get();
    }
}

