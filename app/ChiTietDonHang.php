<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    //
    protected $table='ChiTietDonHang';

    function donhang(){
    	return $this->belongsTo('App\DonHang','idDH','id');
    }
    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
}
