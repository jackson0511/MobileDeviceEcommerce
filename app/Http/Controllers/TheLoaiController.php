<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\ThuocTinh;
class TheLoaiController extends Controller
{
    //
    public function getList(){
        $theloai=TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getAdd(){
        $thuoctinh=ThuocTinh::all();
        return view('admin.theloai.them',['thuoctinh'=>$thuoctinh]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'				=>'required',
                'trangthai' 		=>'required',
                'thuoctinh'         =>'required'
            ]
            ,[
                'ten.required'		=>'Bạn chưa nhập tên',
                'trangthai.required'=>'Ban chưa chọn trạng thái',
                'thuoctinh.required'=>'Ban chưa chọn thuộc tính',
            ]);
        $theloai=new TheLoai();
        $theloai->Ten=$this->request->ten;
        $theloai->Ten_KhongDau=str_slug($this->request->ten);
        $theloai->TrangThai=$this->request->trangthai;
        $theloai->save();


        if($theloai ) {
            $idtheloai=$theloai->id;
            $thuoctinh = $this->request->thuoctinh;
            foreach ($thuoctinh as $key => $idtt) {
                $tl = TheLoai::find($idtheloai);
                $tl->thuoctinh()->attach($idtt);
            }
        }
        return redirect('admin/theloai/danhsach')->with('ThongBao','Thêm thành công');

    }
    public function getEdit($id){
        $theloai=TheLoai::find($id);
        $thuoctinh=ThuocTinh::all();
        return view('admin/theloai/sua',['theloai'=>$theloai,'thuoctinh'=>$thuoctinh]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'				=>'required',
                'trangthai' 		=>'required',
                'thuoctinh'         =>'required'
            ]
            ,[
                'ten.required'		=>'Bạn chưa nhập tên',
                'trangthai.required'=>'Ban chưa chọn trạng thái',
                'thuoctinh.required'=>'Ban chưa chọn thuộc tính',
            ]);
        $theloai=TheLoai::find($id);
        $theloai->Ten=$this->request->ten;
        $theloai->Ten_KhongDau=str_slug($this->request->ten);
        $theloai->TrangThai=$this->request->trangthai;
        $theloai->save();
        if($theloai) {
            $idtheloai = $theloai->id;
            $thuoctinh = $this->request->thuoctinh;
            $theloai->thuoctinh()->detach();
            foreach ($thuoctinh as $key => $idtt) {
                $tl = TheLoai::find($idtheloai);
                $tl->thuoctinh()->attach($idtt);
            }
        }
        return redirect('admin/theloai/danhsach')->with('ThongBao','Cập nhập thành công');

    }
    public function getDelete($id){
        $theloai=TheLoai::find($id);
        if(count($theloai->sanpham)>0){
            return redirect('admin/theloai/danhsach')->with('ThongBao','Không xoá được vì có sản phẩm');
        }else{
            $theloai->delete();
            $theloai->thuoctinh()->detach();
            return redirect('admin/theloai/danhsach')->with('ThongBao','Xoá thành công');
        }
    }
    public function getXuLy($id){
        $theloai=TheLoai::find($id);
        if($theloai->TrangThai==0){
            $theloai->TrangThai=1;
        }else{
            $theloai->TrangThai=0;
        }
        $theloai->save();
        return redirect('admin/theloai/danhsach')->with('ThongBao','Cập nhập thành công');
    }
}
