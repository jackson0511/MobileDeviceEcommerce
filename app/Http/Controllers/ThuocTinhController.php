<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThuocTinh;
class ThuocTinhController extends Controller
{
    public function getList(){
        $thuoctinh=ThuocTinh::all();
        return view('admin.thuoctinh.danhsach',['thuoctinh'=>$thuoctinh]);
    }
    public function getAdd(){
        return view('admin.thuoctinh.them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'       =>'required',
            ],
            [
                'ten.required'=>'Bạn chưa nhập tên',
            ]);
        $thuoctinh=new ThuocTinh();
        $thuoctinh->Ten=$this->request->ten;
        $thuoctinh->save();
        return redirect('admin/thuoctinh/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $thuoctinh=ThuocTinh::find($id);
        return view('admin.thuoctinh.sua',['thuoctinh'=>$thuoctinh]);
    }
    public function postEdit($id){
        $thuoctinh=ThuocTinh::find($id);
        $this->validate($this->request,
            [
                'ten'       =>'required',
            ],
            [
                'ten.required'=>'Bạn chưa nhập tên',
            ]);
        $thuoctinh->Ten=$this->request->ten;
        $thuoctinh->save();
        return redirect('admin/thuoctinh/danhsach')->with('ThongBao','Sửa thành công');
    }
}
