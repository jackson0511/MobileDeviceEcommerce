<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongTinBaoHanh extends Model
{
    protected $table='ThongTinBaoHanh';

    function sanpham(){
        return $this->belongsTo('App\SanPham','idSP','id');
    }
    function donhang(){
        return $this->belongsTo('App\DonHang','idDH','id');
    }
}
