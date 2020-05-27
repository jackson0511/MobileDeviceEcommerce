<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    protected $table='Quyen';

    function quantri(){
        return $this->belongstoMany('App\QuanTri','chitietquyen','idQ','idQT');
    }
}
