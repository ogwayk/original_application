<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pict extends Model
{
    use HasFactory;


    public static function PictAll()
    {
        $picts= Pict::get();
        return $picts;
    }



}
