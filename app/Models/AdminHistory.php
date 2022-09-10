<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHistory extends Model
{
    use HasFactory;
    protected $fillable = ['type','id_s','user','actions'];

    public static function add_history($type,$id,$user,$action)
    {
        AdminHistory::create([
            'type'=>$type,
            'id_s'=>$id,
            'user'=>$user,
            'actions'=>$action,
        ]);
    }
    public function make_user()
    {
        return $this->belongsTo(User::class,'user','id');
    }
}
