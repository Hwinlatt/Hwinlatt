<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.user',compact('users'));
    }
    public function edit()
    {
        $user = User::find(request('id'));
        return view('admin.user.edituser',compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $request->validate([
            'id'=> 'required',
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'gender'=>'required',
            'city' => 'required',
            'phone_one'=>'required'
        ]);
        if ($request->password) {
            $request->validate([
            'password'=>'min:8|string'
            ],['password.min'=>'The password must be at least 8 characters.Or Nothing']);
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->city = $request->city;
        $user->user_role = $request->user_role;
        $user->phone_one = $request->phone_one;
        $user->phone_two = $request->phone_two;
        $user->update();
        $hiAction = 'updated';
        AdminHistory::add_history('user',$user->id,Auth::user()->id,$hiAction);
        return back()->with('status','Update Successful.');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        AdminHistory::where('id_s',$user->id)->delete();
        return back()->with('success',$user->name . ' deleted successful.');
    }
}
