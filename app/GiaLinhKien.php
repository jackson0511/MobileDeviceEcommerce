<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaLinhKien extends Model
{
    protected $table='Gia_LinhKien';
    function danhmucsanpham(){
        return $this->belongsTo('App\DanhMucSanPham','idDMSP','id');
    }
    public function chitietphieu(){
        return $this->hasMany('App\ChiTietPhieu','idGLK','id');
    }
}
