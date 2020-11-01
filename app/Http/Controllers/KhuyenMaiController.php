<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\KhuyenMai;
use App\SanPham;
use App\LogActiveKM;
use App\ChiTietKhuyenMai;
use Illuminate\Support\Facades\Auth;

class KhuyenMaiController extends Controller
{
    //
    public  $ngay;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        $this->ngay=$ngay;
    }

    public function getList(){
        $khuyenmai=KhuyenMai::orderby('id','desc')->get();
        return view('admin.khuyenmai.danhsach',['khuyenmai'=>$khuyenmai]);
    }
    public function getAdd(){
        $sanpham=SanPham::where('TrangThai',1)->get();
        return view('admin.khuyenmai.them',['sanpham'=>$sanpham,'ngay'=>$this->ngay]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'                   =>'required',
                'hinh'                  =>'required',
                'ngayhieuluc'           =>'required',
                'noidung'               =>'required',
                'sanpham'               =>'required',
            ],
            [
                'ten.required'          =>'Bạn chưa nhập tên',
                'hinh.required'         =>'Bạn chưa chọn hình',
                'ngayhieuluc.required'  =>'Bạn chưa nhập thời gian áp dụng',
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
        $ngayhieuluc=explode('-',$this->request->ngayhieuluc);
        $arr1 = explode ("/", $ngayhieuluc[0]);
        $ngaybatdau = trim($arr1[2])."-".$arr1[1]."-".$arr1[0];
        $arr =explode ("/", $ngayhieuluc[1]);
        $ngayketthuc = $arr[2]."-".$arr[1]."-".trim($arr[0]);

        $khuyenmai->NgayBatDau      =$ngaybatdau;
        $khuyenmai->NgayKetThuc     =$ngayketthuc;

        $khuyenmai->save();
        if ($khuyenmai){
            $idkm=$khuyenmai->id;
            //log active
            $log=new LogActiveKM();
            if ($this->request->trangthai==0){
                $status='Ẩn';
            }else{
                $status='Hiện';
            }
            $log->Ten='Tạo mới khuyến mãi trạng thái '.$status;
            $log->idQT=Auth::guard('QuanTri')->id();
            $log->idKM=$idkm;
            $log->save();
            //
            $idsp=$this->request->sanpham;
            $khuyenmai_id=$this->request->khuyenmai;
            if ($khuyenmai_id==1){
                $chitiet=$this->request->chitiet_km;
            }else{
                $chitiet=$this->request->chitiet_sp;
            }
            foreach ($idsp as $key => $id) {
                //cap nhap gia khuyen mai
                $sanpham=SanPham::find($id);
                if ($khuyenmai_id==1) {
                    $gia_sale = $sanpham->Gia * (100 - $chitiet) / 100;
                }else{
                    $gia_sale=NULL;
                }
                ChiTietKhuyenMai::insert([
                    'ChiTiet'		=>$chitiet,
                    'Gia_Sale'      =>$gia_sale,
                    'idSP'			=>$id,
                    'idKM'			=>$idkm,
                    'TrangThai'     =>$khuyenmai_id,
                ]);
            }

        }
        return redirect('admin/khuyenmai/danhsach')->with('ThongBao',' Thêm khuyến mãi thành công');
    }
    public function getEdit($id){
        $khuyenmai=KhuyenMai::find($id);
        $sanpham=SanPham::where('TrangThai',1)->get();
        return view('admin.khuyenmai.sua',['sanpham'=>$sanpham,'khuyenmai'=>$khuyenmai,'ngay'=>$this->ngay]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'                   =>'required',
//                'ngayhieuluc'           =>'required',
                'noidung'               =>'required',
                'sanpham'               =>'required',
            ],
            [
                'ten.required'          =>'Bạn chưa nhập tên',
//                'ngayhieuluc.required'  =>'Bạn chưa nhập thời gian áp dụng',
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
        if ($this->request->ngayhieuluc){
            $ngayhieuluc=explode('-',$this->request->ngayhieuluc);
            $arr1 = explode ("/", $ngayhieuluc[0]);
            $ngaybatdau = trim($arr1[2])."-".$arr1[1]."-".$arr1[0];
            $arr =explode ("/", $ngayhieuluc[1]);
            $ngayketthuc = $arr[2]."-".$arr[1]."-".trim($arr[0]);

            $khuyenmai->NgayBatDau      =$ngaybatdau;
            $khuyenmai->NgayKetThuc     =$ngayketthuc;
        }else{
            $khuyenmai->NgayBatDau      =$khuyenmai->NgayBatDau;
            $khuyenmai->NgayKetThuc     =$khuyenmai->NgayKetThuc;
        }

        $khuyenmai->save();
        if ($khuyenmai){
            $idkm=$khuyenmai->id;
            //log active
            $log=new LogActiveKM();
            if ($this->request->trangthai==0){
                $status='Ẩn';
            }else{
                $status='Hiện';
            }
            $log->Ten='Sửa ngày kết thúc mới '.$this->request->ngayketthuc.' và trạng thái '.$status;
            $log->idQT=Auth::guard('QuanTri')->id();
            $log->idKM=$idkm;
            $log->save();
            //
            $idsp=$this->request->sanpham;
            $khuyenmai_id=$this->request->khuyenmai;
            if ($khuyenmai_id==1){
                $chitiet=$this->request->chitiet_km;
            }else{
                $chitiet=$this->request->chitiet_sp;
            }
            $khuyenmai->chitietkhuyenmai()->delete();
            foreach ($idsp as $key => $id) {
                //cap nhap gia khuyen mai
                $sanpham=SanPham::find($id);
                if ($khuyenmai_id==1) {
                    $gia_sale = $sanpham->Gia * (100 - $chitiet) / 100;
                }else{
                    $gia_sale=NULL;
                }
                ChiTietKhuyenMai::insert([
                    'ChiTiet'		=>$chitiet,
                    'Gia_Sale'      =>$gia_sale,
                    'idSP'			=>$id,
                    'idKM'			=>$idkm,
                    'TrangThai'     =>$khuyenmai_id,
                ]);
            }

        }
        return redirect('admin/khuyenmai/danhsach')->with('ThongBao',' Cập nhập khuyến mãi thành công');
    }
    public function update_status($id){
        $khuyenmai=KhuyenMai::find($id);
        if ($khuyenmai->TrangThai==1){
            $khuyenmai->TrangThai=0;
            $status='Ẩn';
        }else{
            $khuyenmai->TrangThai=1;
            $status='Hiện';
        }
        //log active
        $log=new LogActiveKM();
        $log->Ten='Sửa trạng thái '.$status;
        $log->idQT=Auth::guard('QuanTri')->id();
        $log->idKM=$id;
        $log->save();
        //
        $khuyenmai->save();
        return redirect('admin/khuyenmai/danhsach')->with('ThongBao',' Cập nhập trạng thái thành công');
    }
}
