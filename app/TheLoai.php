<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table='TheLoai';

    function sanpham(){
    	return $this->hasMany('App\SanPham','idTL','id');
    }
    function thuoctinh(){
        return $this->belongstoMany('App\ThuocTinh','TheLoai_ThuocTinh','idTL','idTT');
    }
}
