<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    //
    protected $table='DonHang';

    function chitietdonhang(){
    	return $this->hasMany('App\ChiTietDonHang','idDH','id');
    }
    function quantri(){
    	return $this->belongsTo('App\QuanTri','idQT','id');
    }
    function khachhang(){
    	return $this->belongsTo('App\KhachHang','idKH','id');
    }
}
