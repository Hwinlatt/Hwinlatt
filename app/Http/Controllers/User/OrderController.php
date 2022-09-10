<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdminHistory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->phone_one = $request->phone_one;
        $user->phone_two = $request->phone_two;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->update();
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone_one'=>'required',
            'phone_two'=>'required',
            'address'=>'required',
            'country'=>'required',
            'city'=>'required',
            'total_price'=>'required|numeric|gt:0',
            'payment'=>'required',
        ]);
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_one = $request->phone_one;
        $order->phone_two = $request->phone_two;
        $order->address = $request->address;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->payment = $request->payment;
        $order->total_price = $request->total_price;
        $carts = ShoppingCart::where('userId',Auth::user()->id)->get();
        foreach ($carts as $cart) {
            if ($cart->cartQty > $cart->categories->qty) {
                return back()->with('error','The '.$cart->categories->name.' is not enough! remain is '.$cart->categories->qty);
            }
        }
        $order->save();
        $order->order_code = 'OID-'.date('Ym').'-'.sprintf('%04d', $order->id);;
        $order->update();
        foreach ($carts as $cart) {
            $item = new OrderItem();
            $item->order_code=$order->order_code;
            $item->userId=Auth::user()->id;
            $item->orderQty=$cart->cartQty;
            $item->orderCatgory=$cart->cartCatgory;
            $item->one_price = $cart->categories->price;
            $item->ordercolor = $cart->cartcolor;
            $item->save();
            $cart->delete();
        }

        return redirect('/')->with('status','Your order is receive by multiault admin. We will contant you back soon.');

    }
    public function received(Request $request)
    {
        $order = Order::where('order_code',$request->order_code)->first();
        $order->status = '4';
        $order->received_date = now();
        $order->update();
        $hiAction = '(user) is Received order at '.$order->received_date;
        AdminHistory::add_history('order',$order->order_code,Auth::user()->id,$hiAction);
        return back();
    }
}
