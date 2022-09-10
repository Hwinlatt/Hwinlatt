<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('user.myorders',compact('orders'));
    }
    public function order_info($oid)
    {
        $order_info = Order::where('order_code',$oid)->first();
        $tax = Tax::find(1);
        return view('user.orderinfo',compact('order_info','tax'));
    }
}
