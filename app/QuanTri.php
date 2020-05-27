<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class QuanTri extends Authenticatable
{


    protected $table='QuanTri';

    function quyen(){
        return $this->belongstoMany('App\Quyen','chitietquyen','idQT','idQ');
    }
    function donhang(){
        return $this->hasMany('App\DonHang','idQT','id');
    }
    function tintuc(){
        return $this->hasMany('App\TinTuc','idQT','id');
    }
    function binhluan(){
        return $this->hasMany('App\BinhLuan','idQT','id');
    }
    function khuyenmai(){
        return $this->hasMany('App\KhuyenMai','idQT','id');
    }
    protected $hidden = [
        'password'
    ];

}
