<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhuyenMai;
use App\SanPham;
use App\ChiTietKhuyenMai;
use Illuminate\Support\Facades\Auth;

class KhuyenMaiController extends Controller
{
    //
    public function getList(){
        $khuyenmai=KhuyenMai::orderby('id','desc')->get();
        return view('admin.khuyenmai.danhsach',['khuyenmai'=>$khuyenmai]);
    }
    public function getAdd(){
        $sanpham=SanPham::where('TrangThai',1)->get();
        return view('admin.khuyenmai.them',['sanpham'=>$sanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'                   =>'required',
                'hinh'                  =>'required',
                'ngaybatdau'            =>'required',
                'ngayketthuc'           =>'required',
                'noidung'               =>'required',
                'sanpham'               =>'required',
            ],
            [
                'ten.required'          =>'Bạn chưa nhập tên',
                'hinh.required'         =>'Bạn chưa chọn hình',
                'ngaybatdau.required'   =>'Bạn chưa nhập ngày bắt đầu',
                'ngayketthuc.required'  =>'Bạn chưa nhập ngày kết thúc',
                'noidung.required'      =>'Bạn chưa nhập nội dung',
                'sanpham.required'      =>'Bạn chưa chọn sản phẩm',
            ]);
        $khuyenmai=new KhuyenMai();
        $khuyenmai->Ten             =$this->request->ten;
        $khuyenmai->Ten_KhongDau    =str_slug($this->request->ten);
        $khuyenmai->NoiDung         =$this->request->noidung;
        $khuyenmai->idQT            =Auth::guard('QuanTri')->id();
        $khuyenmai->TrangThai       =$this->request->trangthai;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $anh=str_random(4)."_".$name;
            $file->move('upload/khuyenmai',$anh);
            $khuyenmai->Hinh=$anh;
        }else{
            $khuyenmai->Hinh='';
        }

        $arr1 = explode ("/", $this->request->ngaybatdau);
        if (count($arr1)==3) $this->request->ngaybatdau = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngaybatdau = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $khuyenmai->NgayBatDau      =$this->request->ngaybatdau;
        $khuyenmai->NgayKetThuc     =$this->request->ngayketthuc;

        $khuyenmai->save();
        if ($khuyenmai){
            $idkm=$khuyenmai->id;
            $idsp=$this->request->sanpham;
            $chitiet=$this->request->chitiet;

            foreach ($idsp as $key => $id) {
                //cap nhap gia khuyen mai
                $sanpham=SanPham::find($id);
                $gia_sale=$sanpham->Gia *(100-$chitiet)/100;
                ChiTietKhuyenMai::insert([
                    'ChiTiet'		=>$chitiet,
                    'Gia_Sale'      =>$gia_sale,
                    'idSP'			=>$id,
                    'idKM'			=>$idkm,
                ]);
            }

        }
        return redirect('admin/khuyenmai/danhsach')->with('ThongBao',' Thêm khuyến mãi thành công');
    }
    public function getEdit($id){
        $khuyenmai=KhuyenMai::find($id);
        $sanpham=SanPham::where('TrangThai',1)->get();
        return view('admin.khuyenmai.sua',['sanpham'=>$sanpham,'khuyenmai'=>$khuyenmai]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'                   =>'required',
//                'hinh'                  =>'required',
                'ngaybatdau'            =>'required',
                'ngayketthuc'           =>'required',
                'noidung'               =>'required',
                'sanpham'               =>'required',
            ],
            [
                'ten.required'          =>'Bạn chưa nhập tên',
//                'hinh.required'         =>'Bạn chưa chọn hình',
                'ngaybatdau.required'   =>'Bạn chưa nhập ngày bắt đầu',
                'ngayketthuc.required'  =>'Bạn chưa nhập ngày kết thúc',
                'noidung.required'      =>'Bạn chưa nhập nội dung',
                'sanpham.required'      =>'Bạn chưa chọn sản phẩm',
            ]);
        $khuyenmai=KhuyenMai::find($id);
        $khuyenmai->Ten             =$this->request->ten;
        $khuyenmai->Ten_KhongDau    =str_slug($this->request->ten);
        $khuyenmai->NoiDung         =$this->request->noidung;
        $khuyenmai->idQT            =Auth::guard('QuanTri')->id();
        $khuyenmai->TrangThai       =$this->request->trangthai;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $anh=str_random(4)."_".$name;
            $file->move('upload/khuyenmai',$anh);
            unlink('upload/khuyenmai/'.$khuyenmai->Hinh);
            $khuyenmai->Hinh=$anh;
        }else{
            $khuyenmai->Hinh=$khuyenmai->Hinh;
        }

        $arr1 = explode ("/", $this->request->ngaybatdau);
        if (count($arr1)==3) $this->request->ngaybatdau = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngaybatdau = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $khuyenmai->NgayBatDau      =$this->request->ngaybatdau;
        $khuyenmai->NgayKetThuc     =$this->request->ngayketthuc;

        $khuyenmai->save();
        if ($khuyenmai){
            $idkm=$khuyenmai->id;
            $idsp=$this->request->sanpham;
            $chitiet=$this->request->chitiet;
            $khuyenmai->chitietkhuyenmai()->delete();
            foreach ($idsp as $key => $id) {
                //cap nhap gia khuyen mai
                $sanpham=SanPham::find($id);
                $gia_sale=$sanpham->Gia *(100-$chitiet)/100;
                ChiTietKhuyenMai::insert([
                    'ChiTiet'		=>$chitiet,
                    'Gia_Sale'      =>$gia_sale,
                    'idSP'			=>$id,
                    'idKM'			=>$idkm,
                ]);
            }

        }
        return redirect('admin/khuyenmai/danhsach')->with('ThongBao',' Cập nhập khuyến mãi thành công');
    }
}
