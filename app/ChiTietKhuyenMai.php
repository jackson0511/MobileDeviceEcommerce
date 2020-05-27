<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietKhuyenMai extends Model
{
    //
    protected $table='ChiTietKhuyenMai';
     
    function khuyenmai(){
    	return $this->belongsTo('App\KhuyenMai','idKM','id');
    }
    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
}
