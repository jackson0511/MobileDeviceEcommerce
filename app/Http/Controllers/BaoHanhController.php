<?php

namespace App\Http\Controllers;

use App\BaoHanh;
use App\OptionBaoHanh;
use Illuminate\Http\Request;

class BaoHanhController extends Controller
{
    public function getList(){
        $baohanh=BaoHanh::all();
        return view('admin.baohanh.danhsach',['baohanh'=>$baohanh]);
    }
    public function getAdd(){
        $optionbaohanh=OptionBaoHanh::all();
        return view('admin.baohanh.them',['optionbaohanh'=>$optionbaohanh]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
               'ten'            =>'required',
               'mota'           =>'required'
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'mota.required'  =>'Bạn chưa nhập mô tả',
            ]);
        $baohanh=new BaoHanh();
        $baohanh->Ten       =$this->request->ten;
        $baohanh->MoTa      =$this->request->mota;
        $baohanh->save();
        if ($baohanh){
            $option=$this->request->option;
            foreach ($option as $idop){
                $baohanh->optionbaohanh()->attach($idop);
            }
        }
        return redirect('admin/baohanh/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $baohanh=BaoHanh::find($id);
        $optionbaohanh=OptionBaoHanh::all();
        return view('admin.baohanh.sua',['baohanh'=>$baohanh,'optionbaohanh'=>$optionbaohanh]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'            =>'required',
                'mota'           =>'required'
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'mota.required'  =>'Bạn chưa nhập mô tả',
            ]);
        $baohanh=BaoHanh::find($id);
        $baohanh->Ten       =$this->request->ten;
        $baohanh->MoTa      =$this->request->mota;
        $baohanh->save();
        if ($baohanh){
            $option=$this->request->option;
            $baohanh->optionbaohanh()->detach();
            foreach ($option as $idop){
                $baohanh->optionbaohanh()->attach($idop);
            }
        }
        return redirect('admin/baohanh/danhsach')->with('ThongBao','Cập nhập thành công');
    }
}
