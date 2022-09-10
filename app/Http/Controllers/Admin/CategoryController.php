<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(12);
        return view('admin.category.category', compact('categories'));
    }
    // ------------------------------------
    public function add()
    {
        $category_types = CategoryType::orderBy('type_name','ASC')->get();
        return view('admin.category.addCategory', compact('category_types'));
    }
    // ------------------------------------
    public function insert(Request $request)
    {
        $this->category_validate($request);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $category = new Category();
        if ($request->hasFile('image')) {
            $this->save_image($request, $category);
        }
        $this->category_add($request, $category);
        return redirect()->route('admin#category')->with("status", "Create " . $request->name . " successfully");
    }
    // ------------------------------------
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.editCategory', compact('category'));
    }
    // ------------------------------------
    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $this->category_validate($request);
        if ($request->hasFile('image')) {
            $path = 'storage/category/'.$category->image;
            if (File::exists($path)) {
                File::delete($path);
                $this->save_image($request,$category);
            }
        }
        $this->category_add($request, $category);
            return redirect()->route('admin#category')->with('status',$request->name.' upadated successfully');
    }
    // ------------------------------------
    public function search(Request $request)
    {
        $key = $request->inputSearchCategory;
        $categories = Category::search($key);
        if (strlen($key) <= 0) {
            return redirect()->route('admin#category');
        }
        return view('admin.category.category',compact('categories','key'));
    }
    // ------------------------------------
    public function destroy(Request $request)
    {
        $category = Category::find($request->delId);
        $path = 'storage/category/'.$category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
        return response()->json(['success'=>$category->name." deleted!"]);
    }









    private function category_add($req, $db)
    {
        $db->tags= $req->tags;
        $db->name = $req->name;
        $db->type = $req->type;
        $db->company = $req->company;
        $db->price = $req->price;
        $db->populer = $req->populer ? '1' : '0';
        $db->available = $req->available ? '1' : '0';
        $db->colors = $req->color;
        $db->description = $req->description;
        $db->qty = $req->qty;
        $db->save();
    }
    private function category_validate($req)
    {
        $req->validate([
            'name' => 'required',
            'company' => 'required',
            'price' => 'required|numeric|gt:0',
            'type' => 'required',
            'color' => 'required',
            'description' => 'required',
            'qty' => 'required',
        ]);
    }

    private function save_image($req, $c)
    {
        $image_name = uniqid().$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/category',$image_name);
        $c->image = $image_name;
    }
}
