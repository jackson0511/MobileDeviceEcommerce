<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GiaLinhKien;
use App\DanhMucSanPham;
class GiaLinhKienController extends Controller
{
    public function getList(){
        $gialinhkien=GiaLinhKien::all();
        return view('admin.gialinhkien.danhsach',['gialinhkien'=>$gialinhkien]);
    }
    public function getAdd(){
        $danhmucsanpham=DanhMucSanPham::all();
        return view('admin.gialinhkien.them',['danhmucsanpham'=>$danhmucsanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'               =>'required',
                'gia'               =>'required',
                'soluong'           =>'required',
            ],
            [
                'ten.required'      =>'Bạn chưa nhập tên',
                'gia.required'      =>'Bạn chưa nhập giá',
                'soluong.required'  =>'Bạn chưa nhập số lượng',
            ]);
        $gialinhkien=new GiaLinhKien();
        $gialinhkien->Ten_LinhKien    =$this->request->ten;
        $gialinhkien->Gia_Sua         =$this->request->gia;
        $gialinhkien->SoLuong         =$this->request->soluong;
        $gialinhkien->TrangThai       =$this->request->trangthai;
        $gialinhkien->idDMSP          =$this->request->danhmucsanpham;
        $gialinhkien->save();
        return redirect('admin/gialinhkien/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $gialinhkien=GiaLinhKien::find($id);
        $danhmucsanpham=DanhMucSanPham::all();
        return view('admin.gialinhkien.sua',['danhmucsanpham'=>$danhmucsanpham,'gialinhkien'=>$gialinhkien]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'               =>'required',
                'gia'               =>'required',
                'soluong'           =>'required',
            ],
            [
                'ten.required'      =>'Bạn chưa nhập tên',
                'gia.required'      =>'Bạn chưa nhập giá',
                'soluong.required'  =>'Bạn chưa nhập số lượng',
            ]);
        $gialinhkien=GiaLinhKien::find($id);
        $gialinhkien->Ten_LinhKien    =$this->request->ten;
        $gialinhkien->Gia_Sua         =$this->request->gia;
        $gialinhkien->SoLuong         =$this->request->soluong;
        $gialinhkien->TrangThai       =$this->request->trangthai;
        $gialinhkien->idDMSP          =$this->request->danhmucsanpham;
        $gialinhkien->save();
        return redirect('admin/gialinhkien/danhsach')->with('ThongBao','Sửa thành công');
    }
    public function import_csv(){

    }
}
