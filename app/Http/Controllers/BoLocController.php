<?php

namespace App\Http\Controllers;

use App\BoLoc;
use Illuminate\Http\Request;

class BoLocController extends Controller
{
    public function getList(){
        $boloc=BoLoc::all();
        return view('admin.boloc.danhsach',['boloc'=>$boloc]);
    }
    public function getAdd(){
        $boloc=BoLoc::where('parent_id',0)->get();
        return view('admin.boloc.them',['boloc'=>$boloc]);
        
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'               =>'required',
            ],
            [
                'ten.required'      =>'Bạn chưa nhập tên',
            ]);
        $boloc=new BoLoc();
        $boloc->Ten         =$this->request->ten;
        $boloc->parent_id   =$this->request->parent_id;
        $boloc->TrangThai   =$this->request->trangthai;
        $boloc->Ten_KhongDau = str_slug($this->request->ten);        
        $boloc->save();
        return redirect('admin/boloc/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $boloc=BoLoc::where('parent_id',0)->get();
        $boloc_edit=BoLoc::find($id);
        return view('admin.boloc.sua',['boloc'=>$boloc,'boloc_edit'=>$boloc_edit]);
        
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'               =>'required',
            ],
            [
                'ten.required'      =>'Bạn chưa nhập tên',
            ]);
        $boloc=BoLoc::find($id);
        $boloc->Ten         =$this->request->ten;
        $boloc->parent_id   =$this->request->parent_id;
        $boloc->TrangThai   =$this->request->trangthai;
        $boloc->Ten_KhongDau = str_slug($this->request->ten);            
        $boloc->save();
        return redirect('admin/boloc/danhsach')->with('ThongBao','Cập nhập thành công');
    }
}
