<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\QuanTri;
use App\SanPham;
use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{
    public function getList(){
        $tintuc=TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getAdd(){
        $sanpham=SanPham::all();
        return view('admin.tintuc.them',['sanpham'=>$sanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'noidung'       =>'required',
                'hinh'          =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'noidung.required'  =>'Bạn chưa nhập nội dung',
                'hinh.required'  =>'Bạn chưa chọn hình',
            ]);
        $tintuc=new TinTuc();
        $tintuc->TieuDe=$this->request->ten;
        $tintuc->TieuDe_KhongDau=str_slug($this->request->ten);
        $tintuc->NoiDung=$this->request->noidung;
        $tintuc->idSP=$this->request->sanpham;
        $idqt=Auth::guard('QuanTri')->id();
        $tintuc->idQT=$idqt;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $hinh=str_random(4)."_".$name;
            $file->move('upload/tintuc',$hinh);
            $tintuc->Hinh=$hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $tintuc=TinTuc::find($id);
        $sanpham=SanPham::all();
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'sanpham'=>$sanpham]);
    }
    public function postEdit($id){
        $tintuc=TinTuc::find($id);
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'noidung'       =>'required',
//                'hinh'          =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'noidung.required'  =>'Bạn chưa nhập nội dung',
//                'hinh.required'  =>'Bạn chưa chọn hình',
            ]);
        $tintuc->TieuDe=$this->request->ten;
        $tintuc->TieuDe_KhongDau=str_slug($this->request->ten);
        $tintuc->NoiDung=$this->request->noidung;
        $tintuc->idSP=$this->request->sanpham;
        $idqt=Auth::guard('QuanTri')->id();
        $tintuc->idQT=$idqt;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $hinh=str_random(4)."_".$name;
            $file->move('upload/tintuc',$hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh=$hinh;
        }else{
            $tintuc->Hinh=$tintuc->Hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/danhsach')->with('ThongBao','Sửa thành công');
    }
    public function getDelete($id){
        $tintuc=TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('ThongBao','Xoá thành công');
    }
}
