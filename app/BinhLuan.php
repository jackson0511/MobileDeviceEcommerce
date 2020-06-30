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
    //parent_id
    public function parent(){
        return $this->belongsTo('App\BinhLuan','parent_id');
    }
    public function children(){
        return $this->hasMany('App\BinhLuan','parent_id');
    }
}
