<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageList extends Model
{
    use HasFactory;

    protected $fillable = ['place','image','header','text','link'];
}
