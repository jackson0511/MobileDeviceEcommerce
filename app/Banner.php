<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table='Banner';

    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
    function quantri(){
    	return $this->belongsTo('App\QuanTri','idQT','id');
    }
}
