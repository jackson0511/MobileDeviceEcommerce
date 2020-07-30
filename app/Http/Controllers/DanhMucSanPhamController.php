<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DanhMucSanPham;
class DanhMucSanPhamController extends Controller
{
    public function getList(){
        $danhmucsanpham=DanhMucSanPham::all();
        return view('admin.danhmucsanpham.danhsach',['danhmucsanpham'=>$danhmucsanpham]);
    }
    public function getAdd(){
        return view('admin.danhmucsanpham.them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'           =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
            ]);
        $danhmucsanpham=new DanhMucSanPham();
        $danhmucsanpham->Ten    =$this->request->ten;
        $danhmucsanpham->save();
        return redirect('admin/danhmucsanpham/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $danhmucsanpham=DanhMucSanPham::find($id);
        return view('admin.danhmucsanpham.sua',['danhmucsanpham'=>$danhmucsanpham]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'           =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
            ]);
        $danhmucsanpham=DanhMucSanPham::find($id);
        $danhmucsanpham->Ten    =$this->request->ten;
        $danhmucsanpham->save();
        return redirect('admin/danhmucsanpham/danhsach')->with('ThongBao','Sửa thành công');
    }
}
