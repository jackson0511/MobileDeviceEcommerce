<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\TheLoai;
use App\SanPham;
use App\TinTuc;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $theloai=TheLoai::where('TrangThai',1)->get();
        view()->share('theloai',$theloai);
    }

    public function index(){
        $sanpham=SanPham::where('TrangThai',1)->orderByRaw('id DESC')->get();
        $tintuc=TinTuc::orderByRaw('id DESC')->take(4)->get();
        $iphone=SanPham::where('idTL',1)->orderByRaw('id DESC')->get()->random(8);;
        $ipad=SanPham::where('idTL',2)->orderByRaw('id DESC')->take(8)->get();
        $macbook=SanPham::where('idTL',4)->orderByRaw('id DESC')->take(8)->get();
        $applewatch=SanPham::where('idTL',3)->orderByRaw('id DESC')->take(8)->get();
        $phukien=SanPham::where('idTL',5)->orderByRaw('id DESC')->take(8)->get();
        $sanphamhot=SanPham::where('pay','>',0)->orderByRaw('id DESC')->take(5)->get();
//        $khuyenmai=KhuyenMai::where('TrangThai',1)->take(2)->get();
        $banner=Banner::orderByRaw('id DESC')->take(3)->get();
        return view('frontend.subpage.trangchu',
            [
                'banner'        =>$banner,
                'sanpham'       =>$sanpham,
                'iphone'        =>$iphone,
                'ipad'          =>$ipad,
                'macbook'       =>$macbook,
                'applewatch'    =>$applewatch,
                'phukien'       =>$phukien,
                'sanphamhot'    =>$sanphamhot,
                'tintuc'        =>$tintuc,
            ]
        );
    }
    public function productDetail($id){
        $sanpham=SanPham::find($id);
        $sanphamlienquan=SanPham::where('idTL',$sanpham->idTL)->where('TrangThai',1)->get()->random(1);
        return view('frontend.subpage.chitietsanpham',
            [
                'sanpham'           =>$sanpham,
                'sanphamlienquan'   =>$sanphamlienquan,
            ]
        );
    }
    public function getLogin(){
        return view('frontend.subpage.dangnhap');
    }
    public function postLogin(){
        $this->validate($this->request,
            [
                'email'             =>'required',
                'password'          =>'required',
            ],
            [
                'email.required'    =>'Bạn chưa nhập email',
                'password.required'    =>'Bạn chưa nhập mật khẩu',
            ]);
    }
    public function getRegister(){
        return view('frontend.subpage.dangky');
    }
    public function postRegister(){
        dd('aaa');
    }
}
