<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EditPageController extends Controller
{
    public function index()
    {
        $slideShows = HomePageList::where('place', 'slideShow')->orderBy('rating', 'ASC')->get();
        $cards = HomePageList::where('place', 'card')->orderBy('rating', 'ASC')->get();
        return view('admin.editpage.widgets', compact('slideShows', 'cards'));
    }
    public function add()
    {
        return view('admin.editpage.addwidget');
    }
    public function insert(Request $request)
    {
        $this->page_validate('insert',$request,NULL);
        $page_widget = new HomePageList();
        $this->iu_htlp($page_widget, $request);
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/homePage', $fileName);
            $page_widget->image = $fileName;
        }
        $page_widget->save();
        return redirect()->route('admin#edit_page')->with('success', 'Add' . $page_widget->place . ' successfully');
    }
    public function destroy(Request $request)
    {
        $widget = HomePageList::find($request->id);
        $path = 'storage/homePage/' . $widget->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $widget->delete();
        return response()->json(['success' => $widget->header . ' removed from ' . $widget->place]);
    }

    public function edit($id)
    {
        $widget = HomePageList::where('id', $id)->where('header', request('name'))->first();
        return view('admin.editpage.editwidget', compact('widget'));
    }
    public function update(Request $request)
    {
        $widget = HomePageList::where('id', $request->id)->first();
        $this->page_validate('update',$request,$widget->id);
        $this->iu_htlp($widget, $request);
        if ($request->hasFile('image')) {
            $path = 'storage/homePage/' . $widget->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/homePage', $fileName);
        }
        $widget->update();
        return redirect()->route('admin#edit_page')->with('success', 'Update ' . $widget->header . ' successful.');
    }





    private function page_validate($type, $req,$elseId)
    {
        if ($type == 'insert') {
            $req->validate([
                'header' => 'required|unique:home_page_lists,header',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
        }
        if ($type == 'update') {
            $req->validate([
                'header' => 'required|unique:home_page_lists,header,'.$elseId,
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
        }
        $req->validate([
            'link' => 'required',
            'text' => 'required|max:255',
            'place' => 'required|max:255',
        ]);
        if ($req->place == 'card') {
            $req->validate([
                'text' => 'required|max:30',
                'place' => 'required|max:10',
            ],[
                'text.max'=>'The text must not be greater than 30 characters.Because place is card!',
                'place.max'=>'The place must not be greater than 10 characters.Because place is card!'
            ]);
        };
    }

    private function iu_htlp($db, $req)
    {
        $db->header = $req->header;
        $db->text = $req->text;
        $db->link = $req->link;
        $db->place = $req->place;
    }
}
