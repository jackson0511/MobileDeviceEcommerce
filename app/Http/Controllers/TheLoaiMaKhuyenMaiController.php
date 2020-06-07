<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoaiMaKhuyenMai;
use App\MakhuyenMai;
use function GuzzleHttp\Psr7\str;

class TheLoaiMaKhuyenMaiController extends Controller
{
    public function getList(){
        $theloaimakhuyenmai=TheLoaiMaKhuyenMai::orderby('id','desc')->get();
        return view('admin.theloaimakhuyenmai.danhsach',['theloaimakhuyenmai'=>$theloaimakhuyenmai]);
    }
    public function getAdd(){
        return view('admin.theloaimakhuyenmai.them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'                       =>'required',
                'code'                      =>'required|unique:theloaimakhuyenmai,Code',
                'ngayapdung'                =>'required',
                'ngayketthuc'               =>'required',
                'giatri'                    =>'required',
                'soluong'                   =>'required',
            ],
            [
                'ten.required'              =>'Bạn chưa nhập tên ',
                'code.required'             =>'Bạn chưa nhập mã khuyên mãi ',
                'code.unique'               =>'Mã khuyến mãi đã tồn tại ',
                'ngayapdung.required'       =>'Bạn chưa nhập ngày áp dụng ',
                'ngayketthuc.required'      =>'Bạn chưa nhập ngày kết thúc ',
                'giatri.required'           =>'Bạn chưa nhập giá trị ',
                'soluong.required'          =>'Bạn chưa nhập số lượng ',
            ]);
        $theloaimakhuyenmai=new TheLoaiMaKhuyenMai();
        $theloaimakhuyenmai->Ten           =$this->request->ten;
        $theloaimakhuyenmai->Code          =$this->request->code;

        $arr1 = explode ("/", $this->request->ngayapdung);
        if (count($arr1)==3) $this->request->ngayapdung = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngayapdung = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $theloaimakhuyenmai->NgayApDung    =$this->request->ngayapdung;
        $theloaimakhuyenmai->NgayKetThuc   =$this->request->ngayketthuc;
        $theloaimakhuyenmai->GiaTri        =$this->request->giatri;
        $theloaimakhuyenmai->SoLuong        =$this->request->soluong;
        $theloaimakhuyenmai->TrangThai     =$this->request->trangthai;
        $theloaimakhuyenmai->save();
        if($theloaimakhuyenmai){
            for ($i=1;$i<=$this->request->soluong;$i++) {
                $makhuyenmai=new MakhuyenMai();
                $makhuyenmai->Code = $theloaimakhuyenmai->Code . '_' . str_random(4);
                $makhuyenmai->TrangThai = 0;
                $makhuyenmai->idTLMKM = $theloaimakhuyenmai->id;

                $makhuyenmai->save();
            }
        }

        return redirect('admin/theloaimakhuyenmai/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $theloaimakhuyenmai=TheLoaiMaKhuyenMai::find($id);
        return view('admin.theloaimakhuyenmai.sua',['theloaimakhuyenmai'=>$theloaimakhuyenmai]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'                       =>'required',
                'ngayapdung'                =>'required',
                'ngayketthuc'               =>'required',
                'giatri'                    =>'required',
            ],
            [
                'ten.required'              =>'Bạn chưa nhập tên ',
                'ngayapdung.required'       =>'Bạn chưa nhập ngày áp dụng ',
                'ngayketthuc.required'      =>'Bạn chưa nhập ngày kết thúc ',
                'giatri.required'           =>'Bạn chưa nhập giá trị ',
            ]);
        $theloaimakhuyenmai=TheLoaiMaKhuyenMai::find($id);
        $theloaimakhuyenmai->Ten           =$this->request->ten;

        $arr1 = explode ("/", $this->request->ngayapdung);
        if (count($arr1)==3) $this->request->ngayapdung = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngayapdung = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $theloaimakhuyenmai->NgayApDung    =$this->request->ngayapdung;
        $theloaimakhuyenmai->NgayKetThuc   =$this->request->ngayketthuc;
        $theloaimakhuyenmai->GiaTri        =$this->request->giatri;
        $theloaimakhuyenmai->TrangThai     =$this->request->trangthai;
        $theloaimakhuyenmai->save();

        return redirect('admin/theloaimakhuyenmai/danhsach')->with('ThongBao',' Cập nhập thành công');
    }
    public function getXuLy($id){
        $theloaimakhuyenmai=TheLoaiMaKhuyenMai::find($id);
        if($theloaimakhuyenmai->TrangThai==1){
            $theloaimakhuyenmai->TrangThai=0;
        }else{
            $theloaimakhuyenmai->TrangThai=1;
        }
        $theloaimakhuyenmai->save();
        return redirect('admin/theloaimakhuyenmai/danhsach')->with('ThongBao',' Cập nhập thành công');
    }
}
