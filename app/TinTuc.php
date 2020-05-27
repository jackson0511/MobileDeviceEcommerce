<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table='TinTuc';

    function quantri(){
    	return $this->belongsTo('App\QuanTri','idQT','id');
    }
}
