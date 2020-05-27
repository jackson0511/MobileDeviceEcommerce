<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    //
    protected $table='KhuyenMai';

    function chitietkhuyenmai(){
    	return $this->hasMany('App\ChiTietKhuyenMai','idKM','id');
    }

    function quantri(){
    	return $this->belongsTo('App\QuanTri','idQT','id');
    }
}
