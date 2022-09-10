<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryTypeController extends Controller
{

    public function index()
    {
        $cat_types = CategoryType::all();
        return view('admin.categoryType.types', compact('cat_types'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category_types,type_name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg:'
        ]);

        $image_name = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/categoryType', $image_name);
        CategoryType::create([
            'type_name' => strtolower($request->name),
            'image' => $image_name,
        ]);
        return back()->with('success', 'Add Successfully');
    }

    public function edit($id)
    {
        $type = CategoryType::find($id);
        $cat_types = CategoryType::all();
        return view('admin.categoryType.types', compact('cat_types', 'type'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category_types,type_name,' . $id,
        ]);
        $cat_type = CategoryType::find($id);
        $categories = Category::where('type',$cat_type->type_name)->get();
        if ($request->hasFile('image')) {
            $path = 'public/categoryType/' . $cat_type->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $image_name = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/categoryType', $image_name);
            $cat_type->image = $image_name;
        }
        $cat_type->type_name = $request->name;
        foreach ($categories as $category) {
            $category->type = $cat_type->type_name;
            $category->update();
        }
        $cat_type->update();
        return redirect()->route('admin#cat_types')->with('success','Updated Successfully');
    }
}
