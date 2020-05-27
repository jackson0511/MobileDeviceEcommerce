<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuocTinh extends Model
{
    //
    protected $table='ThuocTinh';

    function chitietthuoctinh(){
    	return $this->hasMany('App\ChiTietThuoctinh','idTT','id');
    }
    function theloai(){
        return $this->belongstoMany('App\TheLoai','TheLoai_ThuocTinh','idTT','idTL');
    }
}
