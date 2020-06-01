<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaKhuyenMai extends Model
{
    protected $table='MaKhuyenMai';

    function donhang(){
        return $this->hasMany('App\DonHang','idMaKM','id');
    }
}
