<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\SanPham;
use App\Quyen;
class BannerController extends Controller
{
    public function getList(){
        $banner=Banner::all();
        return view('admin/banner/danhsach',['banner'=>$banner]);
    }
    public function getAdd(){
        $sanpham=SanPham::all();
        return view('admin/banner/them',['sanpham'=>$sanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'noidung'       =>'required',
                'hinh'          =>'required',

            ],
            [
                'ten.required'  =>'bạn chưa nhập tên',
                'noidung.required'  =>'bạn chưa nhập nội dung',
                'hinh.required'  =>'bạn chưa chọn hình',
            ]);
        $banner=new Banner();
        $banner->Ten=$this->request->ten;
        $banner->NoiDung=$this->request->noidung;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $hinh=str_random(4)."_".$name;
            $file->move('upload/banner',$hinh);
            $banner->Hinh=$hinh;
        }
        $banner->idSP=$this->request->sanpham;
        $banner->TrangThai=$this->request->trangthai;
        $idqt=Auth::guard('QuanTri')->id();
        $banner->idQT=$idqt;
        $banner->save();
        return redirect('admin/banner/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $sanpham=SanPham::all();
        $banner=Banner::find($id);
        return view('admin/banner/sua',['sanpham'=>$sanpham,'banner'=>$banner]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'noidung'       =>'required',
//                'hinh'          =>'required',

            ],
            [
                'ten.required'  =>'bạn chưa nhập tên',
                'noidung.required'  =>'bạn chưa nhập nội dung',
//                'hinh.required'  =>'bạn chưa chọn hình',
            ]);
        $banner=Banner::find($id);
        $banner->Ten=$this->request->ten;
        $banner->NoiDung=$this->request->noidung;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $hinh=str_random(4)."_".$name;
            $file->move('upload/banner',$hinh);
            unlink('upload/banner/'.$banner->Hinh);
            $banner->Hinh=$hinh;
        }else{
            $banner->Hinh=$banner->Hinh;
        }
        $banner->idSP=$this->request->sanpham;
        $banner->TrangThai=$this->request->trangthai;
        $idqt=Auth::guard('QuanTri')->id();
        $banner->idQT=$idqt;
        $banner->save();
        return redirect('admin/banner/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function getDelete($id){
        $banner=Banner::find($id);
        $banner->delete();
        unlink('upload/banner/'.$banner->Hinh);
        return redirect('admin/banner/danhsach')->with('ThongBao','Xoá thành công');
    }
}
