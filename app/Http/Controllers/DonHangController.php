<?php

namespace App\Http\Controllers;

use App\MakhuyenMai;
use App\ThongTinBaoHanh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DonHang;
use App\ChiTietDonHang;
use PDF;
use App\SanPham;
class DonHangController extends Controller
{
    public function getList(){
        $value=-1;
        $donhang=DonHang::orderby('created_at','desc')->get();
        return view('admin.donhang.danhsach',
            [
                'donhang'   =>$donhang,
                'id'        =>$value,
            ]);
    }
    public function filter_status(){
        $value=$this->request->trangthai;
        $donhang=DonHang::where('TrangThai',$value)->get();
        if ($value==-1){
            $donhang=DonHang::orderby('created_at','desc')->get();
        }
        return view('admin.donhang.danhsach',
            [
                'donhang'   =>$donhang,
                'id'        =>$value,
            ]);
    }
    public function getOrderById(){
        if ($this->request->has('order_id')) {
            $id = $this->request->order_id;
            $donhang=DonHang::where('id',$id)->get();
        }else{
            $id =-1;
        }
        if ($id==-1){
            $donhang=DonHang::orderby('created_at','desc')->get();
        }
        return view('admin.donhang.danhsach',
            [
                'donhang'   =>$donhang,
                'id'        =>$id,
            ]);
    }
    public function getXuly($id){
        $ctdh=ChiTietDonHang::find($id);
        return view('admin.donhang.xuly',['ctdh'=>$ctdh]);
    }
    public function postXuly($id){
        $this->validate($this->request,
            [
                'imei'				=>'required|unique:ChiTietDonHang,IMEI',
            ]
            ,[
                'imei.required'		=>'Bạn chưa nhập imei',
                'imei.unique'		=>'imei đã tồn tại.',
            ]);
        $ctdh=ChiTietDonHang::find($id);

        // $imei=explode('/', $this->request->imei);

        $ctdh->IMEI=$this->request->imei;
        $ctdh->save();
        return redirect('admin/donhang/danhsach')->with('ThongBao','Thêm imei thành công');

    }
    public function getXulydonhang($id){
        $donhang=DonHang::find($id);
        return view('admin.donhang.xulydonhang',['donhang'=>$donhang]);
    }
    public function postXulydonhang($id){
        $donhang=DonHang::find($id);
        foreach ($donhang->chitietdonhang as $chitiet) {
            if($chitiet->IMEI!=null ){
                if($donhang->TrangThai==4){
                    return redirect('admin/donhang/danhsach')->with('ThongBao','Đơn hàng đã được huỷ');
                }elseif($donhang->TrangThai==3){
                    return redirect('admin/donhang/danhsach')->with('ThongBao','Đơn hàng đã được giao');
                }
                else{
                    $trangthai=$this->request->trangthai;
                    //tru so luong san pham trong don hang
                    if($trangthai==1){
                        $this->update_product($id);
                    }
                    if($trangthai==2 && $donhang->TrangThai==0){
                        $this->update_product($id);
                    }
                    if($trangthai==3 && $donhang->TrangThai==0){
                        $this->update_product($id);
                    }
                    if($trangthai==3){
                        Carbon::setLocale('vi');
                        $now=Carbon::now();
                        $now1=Carbon::now();
                        $ngay=$now->toDateString();
                        $ngayketthuc6=$now1->addMonth(6);
                        $ngayketthuc12=$now->addMonth(12);
                        foreach ($donhang->chitietdonhang as $ctdh){
                            $thongtinbaohanh=new ThongTinBaoHanh();
                            if ($ctdh->SoLuong>1){
                                $sanpham=SanPham::find($ctdh->idSP);
                                for ($i=0;$i<$ctdh->SoLuong;$i++){
                                    $thongtinbaohanh=new ThongTinBaoHanh();
                                    $arr_imei=explode('/',$ctdh->IMEI);
                                    $thongtinbaohanh->IMEI=$arr_imei[$i];
                                    $thongtinbaohanh->idSP=$ctdh->idSP;
                                    $thongtinbaohanh->idDH=$ctdh->idDH;
                                    $thongtinbaohanh->NgayApDung=$ngay;
                                    if($sanpham->baohanh->Ten=='6 tháng'){
                                        $thongtinbaohanh->NgayKetThuc=$ngayketthuc6;
                                    }elseif($sanpham->baohanh->Ten=='6 tháng-Phụ kiện') {
                                        $thongtinbaohanh->NgayKetThuc=$ngayketthuc6;
                                    }elseif($sanpham->baohanh->Ten=='12 tháng-Phụ kiện') {
                                        $thongtinbaohanh->NgayKetThuc=$ngayketthuc12;
                                    }else{
                                        $thongtinbaohanh->NgayKetThuc=$ngayketthuc12;
                                    }
                                    $thongtinbaohanh->BaoHanh=$sanpham->baohanh->Ten;
                                    $thongtinbaohanh->save();
                                }
                            }else{
                                $sanpham=SanPham::find($ctdh->idSP);
                                $thongtinbaohanh->IMEI=$ctdh->IMEI;
                                $thongtinbaohanh->idSP=$ctdh->idSP;
                                $thongtinbaohanh->idDH=$ctdh->idDH;
                                $thongtinbaohanh->NgayApDung=$ngay;
                                if($sanpham->baohanh->Ten=='6 tháng'){
                                    $thongtinbaohanh->NgayKetThuc=$ngayketthuc6;
                                }elseif($sanpham->baohanh->Ten=='6 tháng-Phụ kiện') {
                                    $thongtinbaohanh->NgayKetThuc=$ngayketthuc6;
                                }elseif($sanpham->baohanh->Ten=='12 tháng-Phụ kiện') {
                                    $thongtinbaohanh->NgayKetThuc=$ngayketthuc12;
                                }else{
                                    $thongtinbaohanh->NgayKetThuc=$ngayketthuc12;
                                }
                                $thongtinbaohanh->BaoHanh=$sanpham->baohanh->Ten;
                                $thongtinbaohanh->save();
                            }
                        }
                    }
                    $donhang->TrangThai=$trangthai;
                }
                $donhang->save();
                return redirect('admin/donhang/danhsach')->with('ThongBao','Cập nhập trạng thái đơn hàng thành công');

            }else{
                return redirect('admin/donhang/danhsach')->with('ThongBao','Không thể cập nhập trạng thái vì còn sản phẩm chưa cập nhập imei');
            }
        }

    }
    public function getXulyhuy($id){
        $donhang=DonHang::find($id);
        $donhang->TrangThai=4;
        if($donhang->TrangThai==4){
            foreach ($donhang->chitietdonhang as $ctdh)
            {
                //so luong trong hoa don
                $soluong=$ctdh->SoLuong;
                $idsp=$ctdh->idSP;


                $sanpham=SanPham::find($idsp);
                //so luong trong san pham
                $slsanpham=$sanpham->SoLuong;
                $pay=$sanpham->pay;
                //so luong san pham con lai

                $slsanphamconlai=$slsanpham+$soluong;

                //update lai so luong san pham
                $sanpham->SoLuong=$slsanphamconlai;
                $sanpham->pay=$pay-$soluong;

                $sanpham->save();
            }
        }
        $donhang->save();
        return redirect('admin/donhang/danhsach')->with('ThongBao','Huỷ đơn hàng thành công.Do không liên lạc được.');
    }

    public function print_order($order_id){
        //function trong pdf
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadView($this->print_order_convert($order_id));
        return $pdf->stream();
    }
    public function print_order_convert($order_id){
        $donhang=DonHang::find($order_id);
        $chitietdonhang=ChiTietDonHang::where('idDH',$order_id)->get();
        foreach ($chitietdonhang as $ctdh){
            if ($ctdh->TrangThai_KM==2){
                $khuyenmai = $ctdh->GiamGia;
                $sanpham=SanPham::find($khuyenmai);
            }
        }
        $makm=0;
        if($donhang->idMaKM!=0){
            $idkm=$donhang->idMaKM;
            $makm=MakhuyenMai::find($idkm);
        }
        return view('admin.donhang.print_order',
            [
                'donhang'=>$donhang,
                'chitietdonhang'=>$chitietdonhang,
                'sanpham'       =>$sanpham,
                'makm'          =>$makm
            ]);
    }
    public function update_product($id){
        $donhang=DonHang::find($id);
        foreach ($donhang->chitietdonhang as $ctdh)
        {
            //so luong trong hoa don
            $soluong=$ctdh->SoLuong;
            $idsp=$ctdh->idSP;


            $sanpham=SanPham::find($idsp);
            //so luong trong san pham
            $slsanpham=$sanpham->SoLuong;
            //so luong san pham con lai
            if($slsanpham>=$soluong){
                $slsanphamconlai=$slsanpham-$soluong;
            }else{
                return redirect('admin/donhang/danhsach')->with('ThongBao','Số lượng sản phẩm không đủ');
            }
            //update lai so luong san pham
            $sanpham->SoLuong=$slsanphamconlai;

            $sanpham->pay 	 =$sanpham->pay+$soluong;
            $sanpham->save();
        }
    }
}
