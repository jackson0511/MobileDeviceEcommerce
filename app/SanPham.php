<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class SanPham extends Model
{
    //
    protected $table='SanPham';

    function chitietthuoctinh(){
    	return $this->hasMany('App\ChiTietThuocTinh','idSP','id');
    }

    function tintuc(){
        return $this->hasMany('App\TinTuc','idSP','id');
    }
    function banner(){
    	return $this->hasMany('App\Banner','idSP','id');
    }
    function anhslidesp(){
    	return $this->hasMany('App\AnhSlideSP','idSP','id');
    }
    function chitietkhuyenmai(){
    	return $this->hasMany('App\ChiTietKhuyenMai','idSP','id');
    }
    function binhluan(){
    	return $this->hasMany('App\BinhLuan','idSP','id');
    }
    function chitietdonhang(){
    	return $this->hasMany('App\ChiTietDonHang','idSP','id');
    }
    function theloai(){
    	return $this->belongsTo('App\TheLoai','idTL','id');
    }
    function boloc(){
        return $this->belongstoMany('App\BoLoc','SanPham_BoLoc','idSP','idBL');
    }
    function baohanh(){
        return $this->belongsTo('App\Baohanh','idBH','id');
    }

    public function scopeGia($query, $request)
    {
        if ($request->has('gia')) {
            $arr_gia=$request->gia;
            if($arr_gia=='tat-ca'){
                $query->orderBy('Gia','desc');
            }elseif ($arr_gia=='tren-30'){
                $query->where('Gia','>=',30000000);
            }else{
                $gia=explode('-',$arr_gia);
                $tu=$gia[0].'000000';
                $den=$gia[1].'000000';
                $query->whereBetween('Gia',array($tu,$den));
            }
        }

        return $query;
    }

    public function scopeSim($query, $request)
    {
        if ($request->has('sim')) {
            $sim=$request->sim;
            if($sim=='tat-ca'){
                $query= SanPham::select('SanPham.*')
                    ->join('ChiTietThuocTinh', 'SanPham.id', '=', 'ChiTietThuocTinh.idSP')
                    ->join('ThuocTinh', 'ChiTietThuocTinh.idTT', '=', 'ThuocTinh.id')
                    ->where('ThuocTinh.Ten','=', 'Sim');
            }else {
                $query = SanPham::select('SanPham.*', 'ChiTietThuocTinh.ChiTiet')
                    ->join('ChiTietThuocTinh', 'SanPham.id', '=', 'ChiTietThuocTinh.idSP')
                    ->where('ChiTietThuocTinh.ChiTiet', '=', $sim . ' sim');
            }
        }

        return $query;
    }

    public function scopeDungLuong($query, $request)
    {
        if ($request->has('dung_luong')) {
            $dungluong=$request->dung_luong;
            if($dungluong=='tat-ca'){
                $query= SanPham::select('SanPham.*')
                    ->join('ChiTietThuocTinh', 'SanPham.id', '=', 'ChiTietThuocTinh.idSP')
                    ->join('ThuocTinh', 'ChiTietThuocTinh.idTT', '=', 'ThuocTinh.id')
                    ->where('ThuocTinh.Ten','=', 'Dung lượng');
            }else {
                $query = SanPham::select('SanPham.*', 'ChiTietThuocTinh.ChiTiet')
                    ->join('ChiTietThuocTinh', 'SanPham.id', '=', 'ChiTietThuocTinh.idSP')
                    ->where('ChiTietThuocTinh.ChiTiet', '=', $dungluong . ' GB');
            }
        }

        return $query;
    }
}
