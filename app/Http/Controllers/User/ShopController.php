<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(12);
        return view('user.shop',compact('categories'));
    }
    public function detail($id)
    {
        $category = Category::find($id);
        $totalComment = Comment::where('c_id',$id)->count();

        return view('user.shopdetail',compact('category','totalComment'));
    }
    public function category($key)
    {
        if (request('tags')) {
            $key = request('tags');
            $categories = Category::where('tags','like','%'.$key.'%')->paginate(12);
        }else{
            $categories = Category::search($key);
        }
        return view('user.shop',compact('categories','key'));
    }
    public function search(Request $request)
    {
        $key = $request->searchInput;
        if (strlen($key) < 1) {
            return redirect()->route('shop');
        }else{
        return redirect('shop/category/'.$key);
        }
    }

}
