<?php

namespace App\Http\Controllers;

use App\OptionBaoHanh;
use Illuminate\Http\Request;

class OptionBaoHanhController extends Controller
{
    public function getList(){
        $optionbaohanh=OptionBaoHanh::all();
        return view('admin.optionbaohanh.danhsach',['optionbaohanh'=>$optionbaohanh]);
    }
    public function getAdd(){
        return view('admin.optionbaohanh.them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'            =>'required',
                'mota'            =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'mota.required'  =>'Bạn chưa nhập mô tả',
            ]);
        $optionbaohanh=new OptionBaoHanh();
        $optionbaohanh->Ten       =$this->request->ten;
        $optionbaohanh->MoTa      =$this->request->mota;
        $optionbaohanh->save();
        return redirect('admin/optionbaohanh/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $optionbaohanh=OptionBaoHanh::find($id);
        return view('admin.optionbaohanh.sua',['optionbaohanh'=>$optionbaohanh]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'            =>'required',
                'mota'            =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'mota.required'  =>'Bạn chưa nhập mô tả',
            ]);
        $optionbaohanh=OptionBaoHanh::find($id);
        $optionbaohanh->Ten       =$this->request->ten;
        $optionbaohanh->MoTa      =$this->request->mota;
        $optionbaohanh->save();
        return redirect('admin/optionbaohanh/danhsach')->with('ThongBao','Cập nhập thành công');
    }
}
