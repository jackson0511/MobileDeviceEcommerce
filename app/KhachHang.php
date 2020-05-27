<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    //
    protected $table='KhachHang';

    function donhang(){
    	return $this->hasMany('App\DonHang','idKH','id');
    }
    function binhluan(){
    	return $this->hasMany('App\BinhLuan','idKH','id');
    }
    function gopy(){
    	return $this->hasMany('App\GopY','idKH','id');
    }
   
}
