<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $tax = Tax::find(1);
        $carts = ShoppingCart::where('userId',Auth::user()->id)->get();
        return view('user.checkout',compact('carts','tax'));
    }
}
