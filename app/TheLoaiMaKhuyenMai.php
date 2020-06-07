<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoaiMaKhuyenMai extends Model
{
    protected $table='TheLoaiMaKhuyenMai';

    function makhuyenmai(){
        return $this->hasMany('App\MaKhuyenMai','idTLMKM','id');
    }
}
