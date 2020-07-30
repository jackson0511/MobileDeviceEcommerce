<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuBaoHanh extends Model
{
    protected $table='PhieuBaoHanh';
    public function chitietphieu(){
        return $this->hasMany('App\ChiTietPhieu','idPBH','id');
    }
    public function phieutrungtam(){
        return $this->hasOne('App\PhieuTrungTam','idPBH','id');
    }
}
