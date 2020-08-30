<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActiveKM extends Model
{
    //
    protected $table='LogActiveKM';

    function khuyenmai(){
        return $this->belongsTo('App\KhuyenMai','idKM','id');
    }
    function quantri(){
        return $this->belongsTo('App\QuanTri','idQT','id');
    }

}
