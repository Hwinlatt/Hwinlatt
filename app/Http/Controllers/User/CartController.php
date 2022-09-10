<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ShoppingCart;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function index()
    {
        $tax = Tax::find(1);
        $carts = ShoppingCart::where('userId',Auth::user()->id)->get();
        return view('user.cart', compact('carts','tax'));
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cid' => 'required',
            'cartQty' => 'required|gt:0',
            'color' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        };
        $product = Category::find($request->cid);
        if ($product->qty < $request->cartQty) {
            return response()->json(['errors' => [$product->name.' remain '.$product->qty.'. The cart qty is greather than remain!'] ]);
        }
        if ($product) {
            $inCartChk = ShoppingCart::where('userId', Auth::user()->id)
                ->where('cartCatgory', $request->cid)
                ->where('cartcolor', $request->color)
                ->exists();
            if ($inCartChk) {
                return response()->json(['success' => $product->name.' is already added to cart']);
            }
            $cart = new ShoppingCart();
            $cart->userId = Auth::user()->id;
            $cart->cartCatgory = $request->cid;
            $cart->cartcolor = $request->color;
            $cart->cartQty = $request->cartQty;
            $cart->save();
            return response()->json(['success' => $product->name.' added to Cart']);
        }
    }
    public function update(Request $request)
    {
        if ($request->cartQty == '0') {
            $cartrow = ShoppingCart::find($request->cid);
            $cartrow->delete();
            return response()->json(['remove'=>$cartrow->categories->name.' is removed']);
        }
        $cartrow = ShoppingCart::find($request->cid);
        $cartrow->cartQty = $request->cartQty;
        $cartrow->save();
    }
    public function destroy(Request $request)
    {
        $cartrow = ShoppingCart::find($request->removeCartId);
        if ($cartrow->exists()) {
            $cartrow->delete();
            return response()->json(["success"=>$cartrow->categories->name." removed"]);
        }else{
            return response()->json(["error"=>$cartrow->categories->name." not found in Cart!Please refresh Page."]);
        }

    }
    public function count(Request $request)
    {
        $count = ShoppingCart::where('userId',Auth::user()->id)->count();
        return response()->json(['count'=>$count]);
    }
}
