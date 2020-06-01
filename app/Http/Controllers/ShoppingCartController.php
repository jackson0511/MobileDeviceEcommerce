<?php

namespace App\Http\Controllers;

use App\DonHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TheLoai;
use Cart;
use App\SanPham;
use App\ChiTietKhuyenMai;
use App\ChiTietDonHang;
use App\MaKhuyenMai;
use Carbon\Carbon;
use Session;
session_start();
class ShoppingCartController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
        $theloai=TheLoai::where('TrangThai',1)->get();
        view()->share('theloai',$theloai);

    }
    public function addToCart($id){
        $sanpham=SanPham::find($id);
        $ctkm=ChiTietKhuyenMai::where('idSP',$id)->orderby('id','desc')->get();
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        if (Count($ctkm)>0) {
            foreach ($ctkm as $km) {
                $ngaybatdau = $km->khuyenmai->NgayBatDau;
                $ngayketthuc = $km->khuyenmai->NgayKetThuc;

                if ($ngay >= $ngaybatdau && $ngay <= $ngayketthuc && $km->khuyenmai->TrangThai==1) {
                    $gia_sale = $km->Gia_Sale;
                    \Cart::add([
                        'id' => $sanpham->id,
                        'name' => $sanpham->Ten,
                        'qty' => 1,
                        'weight' => 1,
                        'price' => $sanpham->Gia,
                        'options' => [
                            'hinh' => $sanpham->Hinh,
                            'price_sale' => $gia_sale,
                            'detail' => $km->ChiTiet
                        ],
                    ]);
                    break;
                }
            }
            if ($ngay > $ngayketthuc || $ngay <$ngaybatdau){
                \Cart::add([
                    'id' => $sanpham->id,
                    'name' => $sanpham->Ten,
                    'qty' => 1,
                    'weight' => 1,
                    'price' => $sanpham->Gia,
                    'options' => [
                        'hinh' => $sanpham->Hinh,
                        'price_sale' => 0,
                        'detail'    =>null,
                    ],
                ]);
            }
        }else{
            \Cart::add([
                'id' => $sanpham->id,
                'name' => $sanpham->Ten,
                'qty' => 1,
                'weight' => 1,
                'price' => $sanpham->Gia,
                'options' => [
                    'hinh' => $sanpham->Hinh,
                    'price_sale' => 0,
                    'detail'    =>null,
                ],
            ]);
        }
        return redirect()->back();
    }
    public function showCart(){
        if(\Cart::count()>0)
        {
            $sanpham=\Cart::content();
            return view('frontend.subpage.giohang',['sanpham'=>$sanpham]);
        }
        else
        {
            $session_coupon=Session::get('coupon');
            if ($session_coupon){
                 Session::forget('coupon');
            }
            return redirect('/');
        }
    }
    public function deleteCart($idCart){
        \Cart::remove($idCart);
        return redirect('giohang')->with('ThongBao','Xoá giỏ hàng thành công');

    }
    public function check_coupon(){
        $code=$this->request->coupon;
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        $makhuyenmai=MaKhuyenMai::where('Code',$code)->first();
        if($makhuyenmai){
            $ngayapdung=$makhuyenmai->NgayApDung;
            $ngayketthuc=$makhuyenmai->NgayKetThuc;
            if ($ngay>=$ngayapdung && $ngay <=$ngayketthuc  && $makhuyenmai->TrangThai==1){
                $session_coupon=Session::get('coupon');
                if ($session_coupon==true){
                    $cou[]=array(
                        'coupon_id'   =>$makhuyenmai->id,
                        'coupon_code' =>$makhuyenmai->Code,
                        'coupon_money'=>$makhuyenmai->GiaTri,
                    );
                    Session::put('coupon',$cou);
                }else{
                    $cou[]=array(
                        'coupon_id'   =>$makhuyenmai->id,
                        'coupon_code' =>$makhuyenmai->Code,
                        'coupon_money'=>$makhuyenmai->GiaTri,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('success','Nhập mã giảm gía thành công ');
            }else{
                return redirect()->back()->with('error','Mã giảm giá đã hết hạn');
            }
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }
    public function delete_coupon(){
        $session_coupon=Session::get('coupon');
        if ($session_coupon){
            Session::forget('coupon');
        }
        return redirect()->back()->with('success','Xoá mã giảm giá thành công');
    }

    public function getOrder(){
        $sanpham=\Cart::content();
        return view('frontend.subpage.thanhtoan',['sanpham'=>$sanpham]);
    }
    public function postOrder(){
        $donhang=new DonHang();
        $tongtien=str_replace(',', '', \Cart::subtotal(0,3));
        $tongtien_dagiam=$this->request->tongtien_sale;
        $tongtien_dagiam=str_replace(',','',$tongtien_dagiam);
        $iduser=Auth::guard('KhachHang')->user()->id;
        $idqt=2;
        $donhang->TongTien          =$tongtien;
        $donhang->TongTien_DaGiam   =$tongtien_dagiam;
        $donhang->GhiChu            =$this->request->ghichu;
        $donhang->idQT              =$idqt;
        $donhang->idKH              =$iduser;
        if($this->request->hoten && $this->request->diachi && $this->request->sdt){
            $hoten  =$this->request->hoten;
            $diachi =$this->request->diachi;
            $sdt    =$this->request->sdt;

            $donhang->HoTen         =$hoten;
            $donhang->DiaChi        =$diachi;
            $donhang->SoDienThoai   =$sdt;
        }
        if($this->request->coupon_id) {
            $donhang->idMaKM = $this->request->coupon_id;
        }
        $donhang->save();

        $donhangId=$donhang->id;
        if($donhangId){
            $sanpham=\Cart::content();

            foreach($sanpham as $sp){

                ChitietDonHang::insert([
                    'SoLuong' 		=>$sp->qty,
                    'Gia'			=>$sp->price,
                    'GiamGia'       =>$sp->options->detail,
                    'idDH'			=>$donhangId,
                    'idSP'			=>$sp->id,
                ]);
            }
        }
        \Cart::destroy();
        $session_coupon=Session::get('coupon');
            if ($session_coupon){
                Session::forget('coupon');
            }
        return redirect('camon');

    }
}
