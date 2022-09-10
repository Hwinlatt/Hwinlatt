<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history($type,$id)
    {
            $histories = AdminHistory::where('type',$type)->where('id_s',$id)->orderBy('created_at','DESC')->get();
            $key = $id;
            $back = back();
            return view('admin.history.history',compact('histories','key','back'));
    }
}
