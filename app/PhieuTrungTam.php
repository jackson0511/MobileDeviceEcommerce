<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuTrungTam extends Model
{
    protected $table="PhieuTrungTam";

    public function phieubaohanh(){
        return $this->belongsTo('App\PhieuBaoHanh','idPBH','id');
    }
}
