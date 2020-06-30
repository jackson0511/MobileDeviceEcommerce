<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionBaoHanh extends Model
{
    protected $table='OptionBaoHanh';

    function baohanh(){
        return $this->belongstoMany('App\BaoHanh','BaoHanh_Option','idOP','idBH');
    }
}
