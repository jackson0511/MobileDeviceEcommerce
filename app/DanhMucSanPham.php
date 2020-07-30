<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    protected $table='DanhMucSanPham';
    function gialinhkien(){
        return $this->hasMany('App\GiaLinhKien','idDMSP','id');
    }
}
