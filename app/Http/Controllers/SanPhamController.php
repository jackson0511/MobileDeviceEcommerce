<?php

namespace App\Http\Controllers;

use App\BaoHanh;
use App\BoLoc;
use Illuminate\Http\Request;
use App\SanPham;
use App\TheLoai;
use App\ChiTietThuocTinh;
use App\ThuocTinh;
class SanPhamController extends Controller
{
    public function getList(){
        $sanpham=SanPham::all();
        return view('admin.sanpham.danhsach',['sanpham'=>$sanpham]);
    }
    public function getAdd(){
        $theloai1=TheLoai::where('Ten','=','HÀNG CŨ')->first();
        $theloai=TheLoai::where('id','!=',$theloai1->id)->get();
        $boloc=BoLoc::where('parent_id','!=',0)->get();
        $baohanh=BaoHanh::all();
        return view('admin.sanpham.them',['theloai'=>$theloai,'boloc'=>$boloc,'baohanh'=>$baohanh]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'				=>'required',
                'tomtat'			=>'required',
                'gia'				=>'required',
                'soluong'			=>'required',
                'hinh'				=>'required',
                'thuoctinh'			=>'required',
                'noidung'			=>'required',
                'type'			=>'required',
            ]
            ,[
                'ten.required'		=>'Bạn chưa nhập tên',
                'tomtat.required'	=>'Bạn chưa nhập tóm tắt',
                'gia.required'		=>'Bạn chưa nhập giá',
                'soluong.required'	=>'Bạn chưa nhập số lượng',
                'hinh.required'		=>'Bạn chưa chọn hình',
                'noidung.required'	=>'Bạn chưa nhập nội dung',
                'thuoctinh.required'=>'Bạn chưa chọn thuộc tính',
                'type.required'     =>'Bạn chưa nhập type',
            ]);
        $sanpham=new SanPham();
        $sanpham->Ten 			=$this->request->ten;
        $sanpham->Ten_KhongDau	=str_slug($this->request->ten);
        $sanpham->TomTat 		=$this->request->tomtat;
        $sanpham->Gia 			=$this->request->gia;
        $sanpham->SoLuong 		=$this->request->soluong;
        $sanpham->NoiDung 		=$this->request->noidung;
        $sanpham->type 		    =$this->request->type;
        $sanpham->BanChay 		=$this->request->banchay;
        $sanpham->TrangThai 	=$this->request->trangthai;
        $sanpham->TinhTrang 	=$this->request->tinhtrang;
        $sanpham->idTL 			=$this->request->theloai;
        $sanpham->idBH          =$this->request->baohanh;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $anh=str_random(4)."_".$name;
            $file->move('upload/sanpham',$anh);
            $sanpham->Hinh=$anh;
        }else{
            $sanpham->Hinh='';
        }
        $sanpham->save();
        //luu chi tiet thuoc tinh
        if($sanpham){
            $idsp=$sanpham->id;
            $thuoctinh=$this->request->thuoctinh;
            foreach ($thuoctinh as  $tt) {
                foreach ($tt as $idtt => $value) {
                    ChiTietThuocTinh::insert([
                        'ChiTiet'   =>$value,//gia tri
                        'idSP'      =>$idsp,
                        'idTT'      =>$idtt,//idthuoctinh
                    ]);
                }
            }
            //save boloc
            $boloc=$this->request->boloc;
            foreach ($boloc as $key => $idbl) {
                $sanpham->boloc()->attach($idbl);
            }
        }
        return redirect('admin/sanpham/danhsach')->with('ThongBao','Thêm thành công');

    }
    public function getEdit($id){
        $sanpham=SanPham::find($id);
        $theloai1=TheLoai::where('Ten','=','HÀNG CŨ')->first();
        $theloai=TheLoai::where('id','!=',$theloai1->id)->get();
        $theloai_ct=TheLoai::find($sanpham->idTL);
        $baohanh=BaoHanh::all();
        $boloc=BoLoc::where('parent_id','!=',0)->get();
        return view('admin.sanpham.sua',
            [
                'theloai'       =>$theloai,
                'sanpham'       =>$sanpham,
                'theloai_ct'    =>$theloai_ct,
                'boloc'         =>$boloc,
                'baohanh'       =>$baohanh,
            ]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'ten'				=>'required',
                'tomtat'			=>'required',
                'gia'				=>'required',
                'soluong'			=>'required',
//                'thuoctinh'			=>'required',
                'noidung'			=>'required',
                'type'			    =>'required',
            ]
            ,[
                'ten.required'		=>'Bạn chưa nhập tên',
                'tomtat.required'	=>'Bạn chưa nhập tóm tắt',
                'gia.required'		=>'Bạn chưa nhập giá',
                'soluong.required'	=>'Bạn chưa nhập số lượng',
                'noidung.required'	=>'Bạn chưa nhập nội dung',
//                'thuoctinh.required'=>'Bạn chưa chọn thuộc tính',
                'type.required'     =>'Bạn chưa nhập type',
            ]);
        $sanpham=SanPham::find($id);
        $sanpham->Ten 			=$this->request->ten;
        $sanpham->Ten_KhongDau	=str_slug($this->request->ten);
        $sanpham->TomTat 		=$this->request->tomtat;
        $sanpham->Gia 			=$this->request->gia;
        $sanpham->SoLuong 		=$this->request->soluong;
        $sanpham->NoiDung 		=$this->request->noidung;
        $sanpham->type 		    =$this->request->type;
        $sanpham->BanChay 		=$this->request->banchay;
        $sanpham->TrangThai 	=$this->request->trangthai;
        $sanpham->TinhTrang 	=$this->request->tinhtrang;
        $sanpham->idTL 			=$this->request->theloai;
        $sanpham->idBH          =$this->request->baohanh;
        if($this->request->hasFile('hinh')){
            $file=$this->request->file('hinh');
            $name=$file->getClientOriginalName();
            $anh=str_random(4)."_".$name;
            $file->move('upload/sanpham',$anh);
            unlink('upload/sanpham/'.$sanpham->Hinh);
            $sanpham->Hinh=$anh;
        }else{
            $sanpham->Hinh=$sanpham->Hinh;
        }
        $sanpham->save();
        //luu chi tiet thuoc tinh
        if($sanpham){
            $idsp=$sanpham->id;
            $thuoctinh=$this->request->thuoctinh;
            $sanpham->ChiTietThuocTinh()->delete();
            foreach ($thuoctinh as  $tt) {
                foreach ($tt as $idtt => $value) {
                    ChiTietThuocTinh::insert([
                        'ChiTiet'   =>$value,//gia tri
                        'idSP'      =>$idsp,
                        'idTT'      =>$idtt,//idthuoctinh
                    ]);
                }
            }
            //save boloc
            $boloc=$this->request->boloc;
            $sanpham->boloc()->detach();
            foreach ($boloc as $key => $idbl) {
                $sanpham->boloc()->attach($idbl);
            }

        }
        return redirect('admin/sanpham/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function getDelete($id)
    {
        $sanpham = SanPham::find($id);
        if (count($sanpham->anhslidesp) > 0) {
            return redirect('admin/sanpham/danhsach')->with('ThongBao', 'Không xoá được vì ràng buộc dữ liêu');
        } else {
            $sanpham->ChiTietThuocTinh()->delete();
            $sanpham->boloc()->detach();
            $sanpham->delete();

            return redirect('admin/sanpham/danhsach')->with('ThongBao', 'Xoá thành công');
        }
    }

}
