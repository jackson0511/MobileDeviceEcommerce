<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //
    protected $table='SanPham';

    function chitietthuoctinh(){
    	return $this->hasMany('App\ChiTietThuocTinh','idSP','id');
    }

    function banner(){
    	return $this->hasMany('App\Banner','idSP','id');
    }
    function anhslidesp(){
    	return $this->hasMany('App\AnhSlideSP','idSP','id');
    }
    function chitietkhuyenmai(){
    	return $this->hasMany('App\ChiTietKhuyenMai','idSP','id');
    }
    function binhluan(){
    	return $this->hasMany('App\BinhLuan','idSP','id');
    }
    function chitietdonhang(){
    	return $this->hasMany('App\ChiTietDonHang','idSP','id');
    }
    function theloai(){
    	return $this->belongsTo('App\TheLoai','idTL','id');
    }
}
