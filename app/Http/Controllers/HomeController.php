<?php

namespace App\Http\Controllers;

use App\GopY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\TheLoai;
use App\SanPham;
use App\TinTuc;
use App\KhachHang;
use Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $theloai=TheLoai::where('TrangThai',1)->get();
        $tongsanpham=SanPham::all();
        view()->share('theloai',$theloai);
        view()->share('tongsanpham',$tongsanpham);
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
    //chi tiet san pham
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
    //danh sach san pham
    public function productByCategory($id){
        $theloai1=TheLoai::find($id);
        $sanpham=SanPham::where('idTL',$id)->orderByRaw('id DESC')->paginate(8);
        return view('frontend.subpage.danhsachsanpham',
            [
                'sanpham'   =>$sanpham,
                'theloai1'  =>$theloai1
            ]);
    }
    // danh sach san pham ban chay
    public function getDanhsachbanchay(){
        $sanphamhot=SanPham::where('pay','>',0)->orderByRaw('id DESC')->paginate(8);
        return view('frontend.subpage.danhsachsanphambanchay',['sanpham'=>$sanphamhot]);
    }
    //danh sach san pham vua xem
    public function getListProductView($id){
        $listid=explode(',',$id);
        $sanpham=SanPham::whereIn('id',$listid)->orderByRaw('id DESC')->paginate(8);
        return view('frontend.subpage.danhsachsanphamvuaxem',['sanpham'=>$sanpham]);
    }
    //danh sach tin tuc
    public function getListNews(){
        $tintuc=TinTuc::orderByRaw('id DESC')->paginate(6);
        return view('frontend.subpage.danhmuctintuc',
            [
                'tintuc'        =>$tintuc,
            ]);
    }
    //chi tiet tin tuc
    public function getDetailNew($id){
        $tintuc=TinTuc::find($id);
        $tinmoi=TinTuc::orderByRaw('id DESC')->where('id','<>',$id)->take(4)->get();
        $theloai=TheLoai::all();
        return view('frontend.subpage.chitiettintuc',
            [
                'tintuc'    =>$tintuc,
                'tinmoi'    =>$tinmoi,
                'theloai'   =>$theloai,
            ]);

    }
    //gop y
    public function getContact(){
        return view('frontend.subpage.lienhe');
    }
    public function postContact(){
        $this->validate($this->request,
            [
                'noidung'           =>'required',
            ],
            [
                'noidung.required'  =>'Bạn chưa nhập nội dung',
            ]);
        $gopy=new GopY();
        $gopy->NoiDung  =$this->request->noidung;
        $gopy->idKH     =$this->request->hoten;
        $gopy->save();

        return redirect()->back()->with('ThongBao','Cảm ơn bạn chúng tôi đã ghi nhận góp ý của bạn.Chúng tôi sẽ phản hồi lại bạn sớm nhất');

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
        if(Auth::guard('KhachHang')->attempt(['Email'=>$this->request->email,'password'=>$this->request->password,'active'=>1])){
            return redirect('/');
        }elseif(!Auth::guard('KhachHang')->attempt(['Email'=>$this->request->email,'password'=>$this->request->password])){
            return redirect()->back()->with('ThongBao','Tài khoản hoặc mật khẩu không chính xác');
        }else{
            return redirect()->back()->with('ThongBao','Bạn chưa kích hoạt tài khoản');
        }

    }
    public function getLogout(){
        Auth::guard('KhachHang')->logout();
        \Cart::destroy();
        return redirect('/');
    }
    public function getRegister(){
        return view('frontend.subpage.dangky');
    }
    public function postRegister(){
        $this->validate($this->request,
            [
                'email'                 =>'required|unique:KhachHang,Email',
                'password'              =>'required',
                'passwordagain'         =>'required|same:password',
                'name'                  =>'required',
                'diachi'                =>'required',
                'sdt'                   =>'required',
            ]
            ,[
                'email.required'        =>'Bạn chưa nhập  email',
                'email.unique'          =>'Email đã tồn tại',
                'password.required'     =>'Ban chưa nhập mật khẩu',
                'passwordagain.required'=>'Ban chưa nhập lại mật khẩu',
                'passwordagain.same'    =>'Mật khẩu không giống nhau',
                'name.required'         =>'Bạn chưa nhập họ tên',
                'diachi.required'       =>'Bạn chưa nhạp địa chỉ',
                'sdt.required'          =>'Ban chưa nhập sốd điên thoại',
            ]);
        $email=$this->request->email;
        $code=bcrypt(md5(rand(1,99999)));
        $khachhang=new KhachHang();
        $khachhang->Email       =$email;
        $khachhang->password    =bcrypt($this->request->password);
        $khachhang->HoTen       =$this->request->name;
        $khachhang->DiaChi      =$this->request->diachi;
        $khachhang->SoDienThoai =$this->request->sdt;
        $khachhang->code        =$code;

        $khachhang->save();

        //link
        $url=route('get.link.xacnhan',[
            'code'    =>$code,
            'email'   =>$email,
        ]);
        $data=[
            'route'     =>$url,
            'name'      =>$this->request->name,
        ];
        //gui mail
        Mail::send('frontend.subpage.guimail_xacnhan',$data, function($message) use ($email){
            $message->from('thuan.dh51600602@gmail.com','Đức Thuận');
            $message->to($email, 'Xác nhận');
            $message->subject('Gửi mã xác nhận!');
        });

        if($khachhang->id){
            return redirect('dangky')->with('ThongBao','Link xác nhận đăng ký đã được gửi vào email của bạn');
        }else{
            return redirect()->back();
        }

    }
    public function getXacnhan(){
        $code=$this->request->code;
        $email=$this->request->email;

        // dd($code);
        $checkUser=KhachHang::where([
            'code'      =>$code,
            'Email'     =>$email,
        ])->first();

//        dd($checkUser);
        if(!$checkUser){
            return redirect('xacnhan')->with('ThongBao','Xin lỗi đường dẫn không đúng!');
        }
        return view('frontend.subpage.xacnhandangky',['code'=>$code]);
    }
    public function postXacnhan(Request $request){
        $xacnhan=$request->xacnhan;
        $khachhang=KhachHang::where('code',$xacnhan)->first();


        $khachhang->active=1;

        $khachhang->save();

        return redirect('dangnhap')->with('ThongBao','Kích hoạt tài khoản thành công.Vui lòng đăng nhập');
    }
    public function getAccount(){
        $khachhang=KhachHang::find(Auth::guard('KhachHang')->id());
        return view('frontend.subpage.taikhoan',['khachhang'=>$khachhang]);
    }
    public function postAccount(){
        $this->validate($this->request,
            [
                'name'          =>'required',
                'diachi'        =>'required',
                'sdt'           =>'required',
            ]
            ,[
                'name.required'     =>'Bạn chưa nhập tên',
                'diachi.required'   =>'Bạn chưa nhập địa chỉ',
                'sdt.required'      =>'Bạn chư nhập số điện thoại',
            ]);
        $khachhang=Auth::guard('KhachHang')->user();
        $khachhang->HoTen           =$this->request->name;
        $khachhang->DiaChi          =$this->request->diachi;
        $khachhang->SoDienThoai     =$this->request->sdt;
        if($this->request->checkpassword=='on'){
            $this->validate($this->request,
                [
                    'passwordold'           =>'required',
                    'password'              =>'required',
                    'passwordagain'         =>'required|same:password',
                ]
                ,[
                    'password.required'     =>'Bạn chưa nhập mật khẩu',
                    'passwordagain.required'=>'Bạn chưa nhập lại mật khẩu',
                    'passwordagain.same'    =>'Mật khẩu không giống nhau',
                    'passwordold.required'  =>'Bạn chưa nhập mật khẩu cũ',
                ]);

            $khachhang->password   =bcrypt($this->request->password);

        }
        $khachhang->save();
        return redirect('taikhoan')->with('ThongBao','Cập nhập tài khoản thành công');
    }
    public function getCamon(){
        return view('frontend.subpage.camon');
    }
    //tim kiem
    public function getTimkiem(){
        $tukhoa=$this->request->tukhoa;
        $sanpham=SanPham::where('Ten','LIKE','%'.$tukhoa.'%')->orWhere('TomTat','LIKE','%'.$tukhoa.'%')->paginate(8);
        $sanpham->appends(['tukhoa' => $tukhoa]);

        // dd($tukhoa);
        return view('frontend.subpage.timkiem',
            [
                'sanpham'=>$sanpham,
            ]);

    }

}
