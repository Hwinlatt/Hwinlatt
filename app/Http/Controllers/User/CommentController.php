<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index($id)
    {
        $comments = Comment::where('c_id',$id)->orderBy('created_at','desc')->paginate(3);
        // return view('user.loadComponets.categoryCmtLoad',compact('comments'));
    }

    //Delete Comment
    public function destroy(Request $request)
    {
        logger($request);
        Comment::find($request->id)->delete();
        return response()->json('1');
    }

    public function preview($id)
    {
        $amount = request('amount') ? request('amount') :'5';
        $totalComment = Comment::where('c_id',$id)->count();
        $comments = Comment::where('c_id',$id)->orderBy('created_at','desc')->limit($amount)->get();
        return view('user.loadComponets.categoryCmtLoad',compact('comments','totalComment'));
    }
    //Insert Into Cmt
    public function insert(Request $request)
    {
        $validator = $this->commentValidator($request);
        if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $this->saveComment($request);
        return response()->json(['success'=>'1']);

    }

    private function saveComment($request){
        Comment::create([
            'user_id'=>Auth::user()->id,
            'c_id'=>$request->cId,
            'comment'=>$request->comment,
            'rating'=>$request->rating,
        ]);
    }
    private function commentValidator($request){
        return  Validator::make($request->all(),[
            'cId'=>'required|',
            'comment'=>'required|string|min:5',
            'rating'=>'required|min:1|max:4'
        ]);
        
    }
}
