<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GopY extends Model
{
    //
    protected $table='GopY';

    function khachhang(){
    	return $this->belongsTo('App\KhachHang','idKH','id');
    }
}
