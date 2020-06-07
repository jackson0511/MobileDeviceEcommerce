<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakhuyenMai extends Model
{
    protected $table='MaKhuyenMai';

    function theloaimakhuyenmai(){
        return $this->belongsTo('App\TheLoaiMaKhuyenMai','idTLMKM','id');
    }
    function donhang(){
        return $this->hasOne('App\DonHang','idMaKM','id');
    }
}
