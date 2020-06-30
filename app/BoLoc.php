<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoLoc extends Model
{
    protected $table='BoLoc';

    function sanpham(){
        return $this->belongstoMany('App\SanPham','SanPham_BoLoc','idBL','idSP');
    }
    //parent_id
    public function parent(){
        return $this->belongsTo('App\BoLoc','parent_id');
    }
    public function children(){
        return $this->hasMany('App\BoLoc','parent_id');
    }
}
