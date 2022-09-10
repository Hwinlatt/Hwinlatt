<?php

namespace App\Http\Controllers;

use App\Models\CategoryType;
use App\Models\HomePageList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryTypes = CategoryType::all();
        $slideShows = HomePageList::where('place','slideShow')->orderBy('rating','ASC')->get();
        $cards = HomePageList::where('place','card')->orderBy('rating','ASC')->get();
        return view('home',compact('categoryTypes','slideShows','cards'));
    }
}
