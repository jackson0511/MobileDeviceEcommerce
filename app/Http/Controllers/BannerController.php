<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $quantri=Quyen::where('Ten','danhmuc')->select('id')->first()->quantri->pluck('id')->toArray();
        $banner->idQT=$quantri[0];
        $banner->save();
        return redirect('admin/banner/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $sanpham=SanPham::all();
        $banner=Banner::find($id);
        return view('admin/banner/sua',['sanpham'=>$sanpham,'banner'=>$banner]);
    }
    public function postEdit(){
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
        $quantri=Quyen::where('Ten','danhmuc')->select('id')->first()->quantri->pluck('id')->toArray();
        $banner->idQT=$quantri[0];
        $banner->save();
        return redirect('admin/banner/danhsach')->with('ThongBao','Thêm thành công');
    }
}
