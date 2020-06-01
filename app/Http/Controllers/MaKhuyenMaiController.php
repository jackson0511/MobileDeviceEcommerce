<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaKhuyenMai;
class MaKhuyenMaiController extends Controller
{
    public function getList(){
        $makhuyenmai=MaKhuyenMai::orderby('id','desc')->get();
        return view('admin.makhuyenmai.danhsach',['makhuyenmai'=>$makhuyenmai]);
    }
    public function getAdd(){
        return view('admin.makhuyenmai.them');
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'                       =>'required',
                'code'                      =>'required|unique:MaKhuyenMai,Code',
                'ngayapdung'                =>'required',
                'ngayketthuc'               =>'required',
                'giatri'                    =>'required',
            ],
            [
                'ten.required'              =>'Bạn chưa nhập tên ',
                'code.required'             =>'Bạn chưa nhập mã khuyên mãi ',
                'code.unique'               =>'Mã khuyến mãi đã tồn tại ',
                'ngayapdung.required'       =>'Bạn chưa nhập ngày áp dụng ',
                'ngayketthuc.required'      =>'Bạn chưa nhập ngày kết thúc ',
                'giatri.required'           =>'Bạn chưa nhập giá trị ',
            ]);
        $makhuyenmai=new MaKhuyenMai();
        $makhuyenmai->Ten           =$this->request->ten;
        $makhuyenmai->Code          =$this->request->code;

        $arr1 = explode ("/", $this->request->ngayapdung);
        if (count($arr1)==3) $this->request->ngayapdung = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngayapdung = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $makhuyenmai->NgayApDung    =$this->request->ngayapdung;
        $makhuyenmai->NgayKetThuc   =$this->request->ngayketthuc;
        $makhuyenmai->GiaTri        =$this->request->giatri;
        $makhuyenmai->TrangThai     =$this->request->trangthai;
        $makhuyenmai->save();

        return redirect('admin/makhuyenmai/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $makhuyenmai=MaKhuyenMai::find($id);
        return view('admin.makhuyenmai.sua',['makhuyenmai'=>$makhuyenmai]);
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
        $makhuyenmai=MaKhuyenMai::find($id);
        $makhuyenmai->Ten           =$this->request->ten;

        $arr1 = explode ("/", $this->request->ngayapdung);
        if (count($arr1)==3) $this->request->ngayapdung = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngayapdung = date("Y-m-d");

        $arr = explode ("/", $this->request->ngayketthuc);
        if (count($arr)==3) $this->request->ngayketthuc = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngayketthuc = date("Y-m-d");

        $makhuyenmai->NgayApDung    =$this->request->ngayapdung;
        $makhuyenmai->NgayKetThuc   =$this->request->ngayketthuc;
        $makhuyenmai->GiaTri        =$this->request->giatri;
        $makhuyenmai->TrangThai     =$this->request->trangthai;
        $makhuyenmai->save();

        return redirect('admin/makhuyenmai/danhsach')->with('ThongBao',' Cập nhập thành công');
    }
    public function getDelete($id){
        $makhuyenmai=MaKhuyenMai::find($id);
        $makhuyenmai->delete();
        return redirect('admin/makhuyenmai/danhsach')->with('ThongBao',' Xoá thành công');
    }
    public function getXuLy($id){
        $makhuyenmai=MaKhuyenMai::find($id);
        if($makhuyenmai->TrangThai==1){
            $makhuyenmai->TrangThai=0;
        }else{
            $makhuyenmai->TrangThai=1;
        }
        $makhuyenmai->save();
        return redirect('admin/makhuyenmai/danhsach')->with('ThongBao',' Cập nhập thành công');
    }
}
