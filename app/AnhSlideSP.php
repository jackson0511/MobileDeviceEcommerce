<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnhSlideSP extends Model
{
    //
    protected $table='AnhSlideSP';

    function sanpham(){
    	return $this->belongsTo('App\SanPham','idSP','id');
    }
}
