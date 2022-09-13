<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index()
    {
        return view('user.favourite');
    }

    public function getItems()
    {
        
        $fav_items = [];
        $ids = json_decode(request('favs'));
        for ($i=0; $i < count($ids); $i++) { 
            $cat = Category::select('id','name','price','image','type')->find($ids[$i]);
            array_push($fav_items,$cat);
        }
        return response()->json($fav_items);
    }

    public function hello()
    {
        
    }
}
