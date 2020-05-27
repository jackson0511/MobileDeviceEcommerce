<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietThuocTinh extends Model
{
    //
    protected $table='ChiTietThuocTinh';

    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
    function thuoctinh(){
    	return $this->belongsTo('App\ThuocTinh','idTT','id');
    }
}
