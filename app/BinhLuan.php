<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    //
    protected $table='BinhLuan';

    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
    function khachhang(){
    	return $this->belongsTo('App\KhachHang','idKH','id');
    }
    function quantri(){
    	return $this->belongsTo('App\QuanTri','idQT','id');
    }
}
