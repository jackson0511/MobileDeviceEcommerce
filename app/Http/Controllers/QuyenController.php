<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quyen;
class QuyenController extends Controller
{
    public function getList(){
        $quyen=Quyen::all();
        return view('admin/quyen/danhsach',['quyen'=>$quyen]);
    }
    public function getAdd(){
        return view('admin/quyen/them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'         =>'required',
            ],
            [
                'ten.required'=>'Bạn chưa nhập tên',
            ]);
        $quyen=new Quyen();
        $quyen->Ten=$this->request->ten;
        $quyen->save();
        return redirect('admin/quyen/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $quyen=Quyen::find($id);
        return view('admin/quyen/sua',['quyen'=>$quyen]);
    }
    public function postEdit($id){
        $quyen=Quyen::find($id);
        $this->validate($this->request,
            [
                'ten'         =>'required',
            ],
            [
                'ten.required'=>'Bạn chưa nhập tên',
            ]);
        $quyen->Ten=$this->request->ten;
        $quyen->save();
        return redirect('admin/quyen/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function getDelete($id){
        $quyen=Quyen::find($id);
        $quyen->delete();
        return redirect('admin/quyen/danhsach')->with('ThongBao','Xoá thành công');
    }
}
