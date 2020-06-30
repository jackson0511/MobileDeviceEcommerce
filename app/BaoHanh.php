<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaoHanh extends Model
{
    protected $table='BaoHanh';

    function sanpham(){
        return $this->hasMany('App\SanPham','idSP','id');
    }
    function optionbaohanh(){
        return $this->belongstoMany('App\OptionBaoHanh','BaoHanh_Option','idBH','idOP');
    }
}
