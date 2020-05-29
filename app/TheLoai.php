<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table='TheLoai';
    protected $guarded = ['id'];

    function sanpham(){
    	return $this->hasMany('App\SanPham','idTL','id');
    }
    function thuoctinh(){
        return $this->belongstoMany('App\ThuocTinh','TheLoai_ThuocTinh','idTL','idTT');
    }
    //parent_id
    public function parent(){
        return $this->belongsTo('App\TheLoai','parent_id');
    }
    public function children(){
        return $this->hasMany('App\TheLoai','parent_id');
    }
}
