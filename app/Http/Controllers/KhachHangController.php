<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhachHang;
class KhachHangController extends Controller
{
    public function getList(){
        $khachhang=KhachHang::all();
        return view('admin/khachhang/danhsach',['khachhang'=>$khachhang]);
    }
    public function getXuLy($id){
        $khachhang=KhachHang::find($id);
        if($khachhang->active==0){
            return redirect('admin/khachhang/danhsach')->with('ThongBao','Tài khoản chưa được kích hoạt ');
        }else{
            $active=0;
            $khachhang->active=$active;
            $khachhang->save();
            return redirect('admin/khachhang/danhsach')->with('ThongBao','Khoá thành công');
        }
    }

}
