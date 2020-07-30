<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieu extends Model
{
    protected $table='ChiTietPhieu';

    public function phieubaohanh(){
        return $this->belongsTo('App\PhieuBaoHanh','idPBH','id');
    }
    public function gialinhkien(){
        return $this->belongsTo('App\GiaLinhKien','idGLK','id');
    }
}
