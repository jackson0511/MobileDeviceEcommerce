<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnhSlideSP;
use App\SanPham;
class AnhSlideSanPhamController extends Controller
{
    //
    public function getList(){
        $anhslidesp=AnhSlideSP::all();
        return view('admin/anhslidesp/danhsach',['anhslidesp'=>$anhslidesp]);
    }
    public function getAdd(){
        $sanpham=SanPham::all();
        return view('admin/anhslidesp/them',['sanpham'=>$sanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'anhtren' 			=>'required',
                'anhduoi'			=>'required',
                'sanpham'			=>'required',
            ]
            ,[
                'anhtren.required'	=>'Bạn chưa chọn hình trên',
                'anhduoi.required'	=>'Bạn chưa chọn hình dưới',
                'sanpham.required'	=>'Bạn chưa chọn sản phẩm',
            ]);
        $anhslidesp=new AnhSlideSP();
        $anhslidesp->idSP=$this->request->sanpham;
        if($this->request->hasFile('anhtren')){
            $file=$this->request->file('anhtren');
            $name=$file->getClientOriginalName();
            $anhtren=str_random(4)."_".$name;
            $file->move('upload/anhslidesp',$anhtren);
            $anhslidesp->AnhTren=$anhtren;
        }
        if($this->request->hasFile('anhduoi')){
            $file=$this->request->file('anhduoi');
            $name=$file->getClientOriginalName();
            $anhduoi=str_random(4)."_".$name;
            $file->move('upload/anhslidesp',$anhduoi);
            $anhslidesp->AnhDuoi=$anhduoi;
        }
        $anhslidesp->save();
        return redirect('admin/anhslidesanpham/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $anhslidesp=AnhSlideSP::find($id);
        $sanpham=SanPham::all();
        return view('admin/anhslidesp/sua',['anhslidesp'=>$anhslidesp,'sanpham'=>$sanpham]);
    }
    public function postEdit($id){
        $anhslidesp=AnhSlideSP::find($id);
        $this->validate($this->request,
            [
//                'anhtren' 			=>'required',
//                'anhduoi'			=>'required',
                'sanpham'			=>'required',
            ]
            ,[
//                'anhtren.required'	=>'Bạn chưa chọn hình trên',
//                'anhduoi.required'	=>'Bạn chưa chọn hình dưới',
                'sanpham.required'	=>'Bạn chưa chọn sản phẩm',
            ]);
        $anhslidesp->idSP=$this->request->sanpham;
        if($this->request->hasFile('anhtren')){
            $file=$this->request->file('anhtren');
            $name=$file->getClientOriginalName();
            $anhtren=str_random(4)."_".$name;
            $file->move('upload/anhslidesp',$anhtren);
            unlink('upload/anhslidesp/'.$anhslidesp->AnhTren);
            $anhslidesp->AnhTren=$anhtren;
        }else{
            $anhslidesp->AnhTren=$anhslidesp->AnhTren;
        }
        if($this->request->hasFile('anhduoi')){
            $file=$this->request->file('anhduoi');
            $name=$file->getClientOriginalName();
            $anhduoi=str_random(4)."_".$name;
            $file->move('upload/anhslidesp',$anhduoi);
            unlink('upload/anhslidesp/'.$anhslidesp->AnhDuoi);
            $anhslidesp->AnhDuoi=$anhduoi;
        }else{
            $anhslidesp->AnhDuoi=$anhslidesp->AnhDuoi;
        }
        $anhslidesp->save();
        return redirect('admin/anhslidesanpham/danhsach')->with('ThongBao','Sửa thành công');
    }
    public function getDelete($id){
        $anhslidesp=AnhSlideSP::find($id);
        $anhslidesp->delete();
        return redirect('admin/anhslidesanpham/danhsach')->with('ThongBao','Xoá thành công');
    }
}
