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
use App\TheLoaiMaKhuyenMai;
use Carbon\Carbon;
use Session;
use Mail;
use App\Events\NewOrder;
use App\Events\NotificationOrder;
session_start();
class ShoppingCartController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
        $theloai=TheLoai::where('TrangThai',1)->get();
        $tu=0;
        $den=0;
        $dungluong=0;
        $sim=0;
        $gia=0;
        view()->share('theloai',$theloai);
        view()->share(['tu'=>$tu,'den'=>$den,'dungluong'=>$dungluong,'sim'=>$sim,'gia'=>$gia]);

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
                    //tang san pham
                    if($km->TrangThai==2){
                        //co san pham trong gio hang
                        if (Cart::count()>0) {
                            foreach (Cart::content() as $key => $value) {
                                $idsp = $value->id;
                                if ($idsp == (int)$km->ChiTiet && $id == $km->idSP) {
                                    $idsp_sale=(int)$km->ChiTiet;
                                    $sp_sale=SanPham::find($idsp_sale);
                                    \Cart::add([
                                        [
                                            'id' => $sanpham->id,
                                            'name' => $sanpham->Ten,
                                            'qty' => 1,
                                            'weight' => 1,
                                            'price' => $sanpham->Gia,
                                            'options' => [
                                                'hinh' => $sanpham->Hinh,
                                                'price_sale' => 0,
                                                'detail' => $km->ChiTiet,
                                                'status' => $km->TrangThai,
                                            ]
                                        ],
                                        [
                                            'id' => $sp_sale->id,
                                            'name' => $sp_sale->Ten,
                                            'qty' => 1,
                                            'weight' => 1,
                                            'price' => 0,
                                            'options' => [
                                                'hinh' => $sp_sale->Hinh,
                                                'price_sale' => 0,
                                                'detail' => null,
                                            ]
                                        ]
                                    ]);
                                    if ($value->price!=0) {
                                        \Cart::remove($key);
                                    }
                                    break;
                                }
                            }
                            if($idsp!=(int)$km->ChiTiet){
                                //combo khuyenmai
                                $idsp_sale=(int)$km->ChiTiet;
                                $sp_sale=SanPham::find($idsp_sale);
                                \Cart::add([
                                    [
                                        'id' => $sanpham->id,
                                        'name' => $sanpham->Ten,
                                        'qty' => 1,
                                        'weight' => 1,
                                        'price' => $sanpham->Gia,
                                        'options' => [
                                            'hinh' => $sanpham->Hinh,
                                            'price_sale' => 0,
                                            'detail' => $km->ChiTiet,
                                            'status'=>$km->TrangThai,
                                        ]
                                    ],
                                    [
                                        'id' => $sp_sale->id,
                                        'name' => $sp_sale->Ten,
                                        'qty' => 1,
                                        'weight' => 1,
                                        'price' => 0,
                                        'options' => [
                                            'hinh' => $sp_sale->Hinh,
                                            'price_sale' => 0,
                                            'detail' => null,
//                                            'status'=>null,
                                        ]
                                    ]
                                ]);
                            }
                        }else{
                            //combo khuyenmai
                            $idsp=(int)$km->ChiTiet;
                            $sp_sale=SanPham::find($idsp);
                            \Cart::add([
                                [
                                    'id' => $sanpham->id,
                                    'name' => $sanpham->Ten,
                                    'qty' => 1,
                                    'weight' => 1,
                                    'price' => $sanpham->Gia,
                                    'options' => [
                                        'hinh' => $sanpham->Hinh,
                                        'price_sale' => 0,
                                        'detail' => $km->ChiTiet,
                                        'status'=>$km->TrangThai,
                                    ]
                                ],
                                [
                                    'id' => $sp_sale->id,
                                    'name' => $sp_sale->Ten,
                                    'qty' => 1,
                                    'weight' => 1,
                                    'price' => 0,
                                    'options' => [
                                        'hinh' => $sp_sale->Hinh,
                                        'price_sale' => 0,
                                        'detail' => null,
//                                        'status'=>null,
                                    ]
                                ]
                            ]);
                        }
                    }else {
                        //giam gia %
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
                                'detail' => $km->ChiTiet,
                                'status'=>$km->TrangThai,
                            ],
                        ]);
                    }
                    break;
                }
            }
            //khuyen mai het han hoac trang thai khong ap dung
            if ($ngay > $ngayketthuc || $ngay <$ngaybatdau || $km->khuyenmai->TrangThai==0){
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
                        'status'=>null,
                    ],
                ]);
            }
        }else {
            \Cart::add([
                'id' => $sanpham->id,
                'name' => $sanpham->Ten,
                'qty' => 1,
                'weight' => 1,
                'price' => $sanpham->Gia,
                'options' => [
                    'hinh' => $sanpham->Hinh,
                    'price_sale' => 0,
                    'detail' => null,
                    'status'=>null,
                ],
            ]);
        }
        return redirect('/giohang');
    }
    public function showCart(){
        if(\Cart::count()>0)
        {
            $sanpham_all=SanPham::all();
            $sanpham=\Cart::content();
            return view('frontend.subpage.giohang',['sanpham'=>$sanpham,'sanpham_all'=>$sanpham_all]);
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
    public function update_cart(){

        $soluong=(int)$this->request->soluong;
        $idcart=$this->request->idcart;
        $idsp=$this->request->idsp;
        $sanpham=SanPham::find($idsp);
        //check thong tin
        $sanpham1=\Cart::get($idcart);
        $idsp_sale=(int)$sanpham1->options->detail;
        $idCart = -1;
        $soluong_sp_sale=-1;
        $soluong_sp_cart=-1;
        $check=false;
        $check1=false;
        $id=-1;
        foreach (Cart::content() as $key => $value) {
            if ($idsp_sale == $value->id && $value->price==0) {
                $idCart = $key;
                $soluong_sp_sale=$value->qty;
                $id=$value->id;

            }
            //cap nhap so luong san pham trong khuyen mai trung voi san pham trong gio hang
            if ($idsp==$value->id && $value->price==0){
                $soluong_sp_sale=$value->qty;
            }
            //cap nhap so luong san pham trung voi san pham khuyen mao
            if ($idsp_sale==$value->id){
                $soluong_sp_cart=$value->qty;
            }
        }
        if ($id!=-1 && $soluong_sp_cart!=-1){
            $sp=SanPham::find($id);
            $check=$sp->SoLuong<$soluong+$soluong_sp_cart;
        }
        if ($soluong_sp_sale!=-1){
            $check1=$sanpham->SoLuong<$soluong+$soluong_sp_sale;
        }
        //
        if($sanpham->SoLuong<$soluong   || $check1 ) {
            echo "Số lượng vượt quá số lượng sản phẩm trong kho";
        }else if($check){
            echo "Số lượng sản phẩm khuyến mãi chỉ còn ".$sp->SoLuong;
        }else{
            if ($idCart!=-1) {
                \Cart::update($idCart,$soluong);
            }
            \Cart::update($idcart,$soluong);
            echo 1;
        }
    }
    public function deleteCart($idCart){
        $sanpham=\Cart::get($idCart);
        $chitietkm=ChiTietKhuyenMai::where('idSP',$sanpham->id)->where('TrangThai',2)->first();
        if($chitietkm) {
            $idsp = (int)$chitietkm->ChiTiet;
            $sp=SanPham::find($idsp);
            $idcart = -1;
            foreach (\Cart::content() as $key => $value) {
                if ($idsp == $value->id && $value->price==0) {
                    $idcart = $key;
                }
            }
            if ($idcart!=-1) {
                \Cart::remove($idcart);
            }
        }
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
            $ngayapdung=$makhuyenmai->theloaimakhuyenmai->NgayApDung;
            $ngayketthuc=$makhuyenmai->theloaimakhuyenmai->NgayKetThuc;
            if ($ngay>=$ngayapdung && $ngay <=$ngayketthuc   && $makhuyenmai->theloaimakhuyenmai->TrangThai==1){
                if($makhuyenmai->TrangThai==1){
                    $session_coupon=Session::get('coupon');
                    if ($session_coupon==true){
                        $cou[]=array(
                            'coupon_id'   =>$makhuyenmai->id,
                            'coupon_code' =>$makhuyenmai->Code,
                            'coupon_money'=>$makhuyenmai->theloaimakhuyenmai->GiaTri,
                        );
                        Session::put('coupon',$cou);
                    }else{
                        $cou[]=array(
                            'coupon_id'   =>$makhuyenmai->id,
                            'coupon_code' =>$makhuyenmai->Code,
                            'coupon_money'=>$makhuyenmai->theloaimakhuyenmai->GiaTri,
                        );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('success','Nhập mã giảm giá thành công ');

                }elseif($makhuyenmai->TrangThai==2){
                    return redirect()->back()->with('error','Mã giảm giá đã được sử dụng ');
                }else{
                    return redirect()->back()->with('error','Mã giảm giá chưa được phát hành ');
                }
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
        //event khi có đơn hàng mới
        $order=DonHang::find($donhangId);
//        event(new NewOrder($order));
//        event( new NotificationOrder($order));
        //
        if($donhangId){
            $sanpham=\Cart::content();

            foreach($sanpham as $sp){

                ChitietDonHang::insert([
                    'SoLuong' 		=>$sp->qty,
                    'Gia'			=>$sp->price,
                    'GiamGia'       =>$sp->options->detail,
                    'TrangThai_KM'  =>$sp->options->status,
                    'idDH'			=>$donhangId,
                    'idSP'			=>$sp->id,
                ]);
            }
        }
        //tang coupon
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        $theloaikm=TheLoaiMaKhuyenMai::where('Code','APPLE-MENBER')->first();
        $ngayapdung=$theloaikm->NgayApDung;
        $ngaykethuc=$theloaikm->NgayKetThuc;
        if($tongtien>=50000000 && $ngay>=$ngayapdung && $ngay<=$ngaykethuc && $theloaikm->TrangThai==1){
            $makhuyenmai=MaKhuyenMai::where('idTLMKM',$theloaikm->id)->get();
            foreach ($makhuyenmai as $makm){
                if($makm->TrangThai==0){
                    $code=$makm->Code;
                    if ($this->request->hoten){
                        $data=[
                            'name'      =>$this->request->hoten,
                            'code'      =>$code,
                            'ngayapdung'=>$theloaikm->NgayApDung,
                            'ngaykethuc'=>$theloaikm->NgayKetThuc,
                        ];
                    }else{
                        $data=[
                            'name'      =>Auth::guard('KhachHang')->user()->HoTen,
                            'code'      =>$code,
                            'ngayapdung'=>$theloaikm->NgayApDung,
                            'ngaykethuc'=>$theloaikm->NgayKetThuc,
                        ];
                    }
                    //email nguoi mua hang
                    $email=Auth::guard('KhachHang')->user()->Email;
                    //gui mail
                    Mail::send('frontend.email-template.coupon',$data, function($message) use ($email){
                        $message->from('thuan.dh51600602@gmail.com','Đức Thuận');
                        $message->to($email, 'Tặng mã khuyến mãi');
                        $message->subject('Tặng mã khuyến mãi!');
                    });
                    //update trang thai ma khuyen mai len 1
                    $coupon = MaKhuyenMai::where('Code',$code)->first();
                    $coupon->TrangThai=1;
                    $coupon->save();
                    break;
                }
            }
        }
        //
        \Cart::destroy();
        $session_coupon=Session::get('coupon');
            if ($session_coupon){
                foreach ($session_coupon as $cou){
                    $id_cou=$cou['coupon_id'];
                }
                $coupon_update=MaKhuyenMai::find($id_cou);
                $coupon_update->TrangThai=2;
                $coupon_update->save();
                //xoa coupon
                Session::forget('coupon');
            }
        return redirect('camon');

    }
}
