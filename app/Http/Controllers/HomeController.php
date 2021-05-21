<?php

namespace App\Http\Controllers;

use App\BoLoc;
use App\ChiTietThuocTinh;
use App\GopY;
use App\MakhuyenMai;
use App\TheLoaiMaKhuyenMai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\TheLoai;
use App\SanPham;
use App\TinTuc;
use App\KhachHang;
use Mail;
use App\KhuyenMai;
use App\DonHang;
use App\ChiTietKhuyenMai;
use App\ChiTietDonHang;
use Session;
use DB;

session_start();

class HomeController extends Controller
{
    //
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $theloai = TheLoai::where('TrangThai', 1)->get();
        $tongsanpham = SanPham::all();
        $boloc = BoLoc::all();
        $tu = 0;
        $den = 0;
        $dungluong = 0;
        $sim = 0;
        $gia = 0;
        view()->share('theloai', $theloai);
        view()->share('tongsanpham', $tongsanpham);
        view()->share('boloc', $boloc);
        view()->share(['tu' => $tu, 'den' => $den, 'dungluong' => $dungluong, 'sim' => $sim, 'gia' => $gia]);
    }


    public function index()
    {
        $sanpham = SanPham::where('TrangThai', 1)->where('TinhTrang', 1)->orderByRaw('id DESC')->get()->random(24);
        $tintuc = TinTuc::orderByRaw('id DESC')->take(4)->get();
        $apple = SanPham::where('idTL', 1)->orderByRaw('id DESC')->get()->random(8);;
        $samsung = SanPham::where('idTL', 2)->orderByRaw('id DESC')->take(8)->get();
        $xiaomi = SanPham::where('idTL', 4)->orderByRaw('id DESC')->take(8)->get();
        $oppo = SanPham::where('idTL', 12)->orderByRaw('id DESC')->take(8)->get();
        $phukien = SanPham::where('idTL', 5)->orderByRaw('id DESC')->take(8)->get();
        $sanphamhot = SanPham::where('pay', '>', 0)->orderByRaw('pay DESC')->take(5)->get();
        //
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $ngay = $now->toDateString();
        $khuyenmai = KhuyenMai::where('TrangThai', 1)->get();
        $sanphamsale = [];
        $arr_id = [];
        $title = '';
        foreach ($khuyenmai as $km) {
            $ngaybatdau = $km->NgayBatDau;
            $ngaykethuc = $km->NgayKetThuc;
            if ($ngay >= $ngaybatdau && $ngay <= $ngaykethuc) {
                $title = 'SẢN PHẨM KHUYẾN MÃI';
                foreach ($km->chitietkhuyenmai as $ctkm) {
                    if ($ctkm->TrangThai == 2) {
                        $arr_id[] = (int)$ctkm->ChiTiet;
                    }
                    $sanphamsale[] = $ctkm;
                }
            }
        }
        $sanphamsale = array_slice($sanphamsale, 0, 5);
        $product_km = SanPham::whereIn('id', $arr_id)->get();
        $banner = Banner::orderByRaw('id DESC')->take(3)->get();
        //show mã khuyến mãi
        $theloaikm = TheLoaiMaKhuyenMai::where('Code', 'COVID19')->first();
        $ngayapdung = $theloaikm->NgayApDung;
        $ngayketthuc = $theloaikm->NgayKetThuc;
        $data_km = array(
            'ngay' => $ngay,
            'ngayapdung' => $ngayapdung,
            'ngayketthuc' => $ngayketthuc,

        );

        return view('frontend.subpage.trangchu',
            [
                'banner' => $banner,
                'sanpham' => $sanpham,
                'apple' => $apple,
                'samsung' => $samsung,
                'xiaomi' => $xiaomi,
                'oppo' => $oppo,
                'phukien' => $phukien,
                'sanphamhot' => $sanphamhot,
                'tintuc' => $tintuc,
                'sanphamsale' => $sanphamsale,
                'product_km' => $product_km,
                'title' => $title,
                'theloaikm' => $theloaikm,
                'data_km' => json_encode($data_km),
            ]
        );
    }

    //chi tiet san pham
    public function productDetail($id)
    {
        $sanpham = SanPham::find($id);
        if ($sanpham->TinhTrang == 1) {
            $product_type = SanPham::where('type', $sanpham->type)->where('TinhTrang', 1)->get();
        } else {
            $product_type = [];
        }
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $ngay = $now->toDateString();
        $ctkhuyenmai = ChiTietKhuyenMai::where('idSP', $id)->get();
        $sanphamlienquan_count = SanPham::where('idTL', $sanpham->idTL)->where('TrangThai', 1)->get();
        if (count($sanphamlienquan_count) > 4) {
            $sanphamlienquan = SanPham::where('idTL', $sanpham->idTL)->where('TrangThai', 1)->get()->random(4);
        } else {
            $sanphamlienquan = SanPham::where('idTL', $sanpham->idTL)->where('TrangThai', 1)->get()->random(1);
        }

        return view('frontend.subpage.chitietsanpham',
            [
                'sanpham' => $sanpham,
                'sanphamlienquan' => $sanphamlienquan,
                'product_type' => $product_type,
                'ngay' => $ngay,
                'ctkhuyenmai' => $ctkhuyenmai,
            ]
        );
    }

    //danh sach san pham
    public function productByCategory($id)
    {
        $sort = 'gia-mac-dinh';
        $dungluong = 'tat-ca-2';
        $arr_gia = 'tat-ca-1';
        $sim = 'tat-ca-3';
        $theloai1 = TheLoai::find($id);
        $sanpham = SanPham::where('idTL', $id)->orderBy('id', 'asc')->paginate(8);
        $array_bl = [];
        if ($this->request->has('gia')) {
            $arr_gia = $this->request->gia;
            $array_bl[] = $arr_gia;
        }
        if ($this->request->has('sim')) {
            $sim = $this->request->sim;
            $array_bl[] = $sim;
        }
        if ($this->request->has('dung_luong')) {
            $dungluong = $this->request->dung_luong;
            $array_bl[] = $dungluong;
        }
        if ($this->request->has('gia') && $this->request->has('sim')) {
            $arr_gia = $this->request->gia;
            $sim = $this->request->sim;
            unset($array_bl);
            $array_bl[] = $arr_gia;
            array_unshift($array_bl, $sim);
        }
        if ($this->request->has('gia') && $this->request->has('dung_luong')) {
            $arr_gia = $this->request->gia;
            $dungluong = $this->request->dung_luong;
            unset($array_bl);
            $array_bl[] = $arr_gia;
            array_unshift($array_bl, $dungluong);
        }
        if ($this->request->has('sim') && $this->request->has('dung_luong')) {
            $sim = $this->request->sim;
            $dungluong = $this->request->dung_luong;
            unset($array_bl);
            $array_bl[] = $sim;
            array_unshift($array_bl, $dungluong);
        }
        if ($this->request->has('sim') && $this->request->has('dung_luong') && $this->request->has('gia')) {
            $sim = $this->request->sim;
            $dungluong = $this->request->dung_luong;
            $arr_gia = $this->request->gia;
            unset($array_bl);
            $array_bl[] = $sim;
            array_unshift($array_bl, $dungluong);
            array_unshift($array_bl, $arr_gia);
        }
        if (count($array_bl) > 0) {
            if (count($array_bl) == 1) {
                $sanpham = SanPham::whereHas('boloc', function ($query) use ($array_bl, $id) {
                    $query->whereIn('Ten_KhongDau', $array_bl);
                    $query->where('idTL', $id);
                })->orderBy('Gia', 'desc')->paginate(8);
            } elseif (count($array_bl) == 2) {
                $sanpham = SanPham::whereHas('boloc', function ($query) use ($array_bl, $id) {
                    $query->whereIn('Ten_KhongDau', $array_bl);
                    $query->where('idTL', $id);
                    $query->groupBy('idSP');
                    $query->havingRaw('COUNT(idSP)>=2');
                })->orderBy('Gia', 'desc')->paginate(8);
            } else {
                $sanpham = SanPham::whereHas('boloc', function ($query) use ($array_bl, $id) {
                    $query->whereIn('Ten_KhongDau', $array_bl);
                    $query->where('idTL', $id);
                    $query->groupBy('idSP');
                    $query->havingRaw('COUNT(idSP)>=3');
                })->orderBy('Gia', 'desc')->paginate(8);
            }
        }
        if ($this->request->sort) {
            $sort = $this->request->sort;
            if ($sort == 'gia-tang-dan') {
                $sanpham = SanPham::where('idTL', $id)->orderBy('Gia', 'asc')->paginate(8);

            } else {
                $sanpham = SanPham::where('idTL', $id)->orderBy('Gia', 'desc')->paginate(8);
            }
            $sanpham->appends(['sort' => $sort]);
        }

        return view('frontend.subpage.danhsachsanpham',
            [
                'sanpham' => $sanpham,
                'theloai1' => $theloai1,
                'sort' => $sort,
                'dungluong' => $dungluong,
                'sim' => $sim,
                'gia' => $arr_gia,
            ]);
    }

    // danh sach san pham ban chay
    public function getDanhsachbanchay()
    {
        $sanphamhot = SanPham::where('pay', '>', 0)->orderByRaw('id DESC')->paginate(8);

        return view('frontend.subpage.danhsachsanphambanchay', ['sanpham' => $sanphamhot]);
    }

    //danh sach san pham vua xem
    public function getListProductView($id)
    {
        $listid = explode(',', $id);
        $sanpham = SanPham::whereIn('id', $listid)->orderByRaw('id DESC')->paginate(8);

        return view('frontend.subpage.danhsachsanphamvuaxem', ['sanpham' => $sanpham]);
    }

    //danh sach san pham khuyen mai
    public function getDanhsachkhuyenmai()
    {
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $ngay = $now->toDateString();
        $khuyenmai = KhuyenMai::where('TrangThai', 1)->get();

        $id = [];
        $arr_id = [];
        foreach ($khuyenmai as $km) {
            $ngaybatdau = $km->NgayBatDau;
            $ngaykethuc = $km->NgayKetThuc;
            if ($ngay >= $ngaybatdau && $ngay <= $ngaykethuc) {
                $id[] = $km->id;
                $sanphamsale = ChiTietKhuyenMai::whereIn('idKM', $id)->orderBy('id', 'asc')->paginate(8);
            }
        }
        //
        foreach ($sanphamsale as $ctkm) {
            if ($ctkm->TrangThai == 2) {
                $arr_id[] = (int)$ctkm->ChiTiet;
            }
        }
        $product_km = SanPham::whereIn('id', $arr_id)->get();

        return view('frontend/subpage/danhsachsanphamkhuyenmai',
            [
                'sanphamsale' => $sanphamsale,
                'product_km' => $product_km,
            ]);
    }

    //danh sach tin tuc
    public function getListNews()
    {
        $tintuc = TinTuc::orderByRaw('id DESC')->paginate(6);

        return view('frontend.subpage.danhmuctintuc',
            [
                'tintuc' => $tintuc,
            ]);
    }

    //chi tiet tin tuc
    public function getDetailNew($id)
    {
        $tintuc = TinTuc::find($id);
        $tinmoi = TinTuc::orderByRaw('id DESC')->where('id', '<>', $id)->take(4)->get();
        $theloai = TheLoai::all();

        return view('frontend.subpage.chitiettintuc',
            [
                'tintuc' => $tintuc,
                'tinmoi' => $tinmoi,
                'theloai' => $theloai,
            ]);

    }

    //gop y
    public function getContact()
    {
        return view('frontend.subpage.lienhe');
    }

    public function postContact()
    {
        $this->validate($this->request,
            [
                'noidung' => 'required',
            ],
            [
                'noidung.required' => 'Bạn chưa nhập nội dung',
            ]);
        $gopy = new GopY();
        $gopy->NoiDung = $this->request->noidung;
        $gopy->idKH = $this->request->hoten;
        $gopy->save();

        return redirect()->back()->with('ThongBao',
            'Cảm ơn bạn chúng tôi đã ghi nhận góp ý của bạn.Chúng tôi sẽ phản hồi lại bạn sớm nhất');

    }

    public function getLogin()
    {
        return view('frontend.subpage.dangnhap');
    }

    public function postLogin()
    {
        $this->validate($this->request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
            ]);
        if (Auth::guard('KhachHang')->attempt([
            'Email' => $this->request->email,
            'password' => $this->request->password,
            'active' => 1,
        ])) {
            return redirect('/');
        } elseif (!Auth::guard('KhachHang')->attempt([
            'Email' => $this->request->email,
            'password' => $this->request->password,
        ])) {
            return redirect()->back()->with('ThongBao', 'Tài khoản hoặc mật khẩu không chính xác');
        } else {
            return redirect()->back()->with('ThongBao', 'Bạn chưa kích hoạt tài khoản');
        }

    }

    public function getLogout()
    {
        Auth::guard('KhachHang')->logout();
        \Cart::destroy();

        return redirect('/');
    }

    public function getRegister()
    {
        return view('frontend.subpage.dangky');
    }

    public function postRegister()
    {
        $this->validate($this->request,
            [
                'email' => 'required|unique:KhachHang,Email',
                'password' => 'required',
                'passwordagain' => 'required|same:password',
                'name' => 'required',
                'diachi' => 'required',
                'sdt' => 'required',
            ]
            , [
                'email.required' => 'Bạn chưa nhập  email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Ban chưa nhập mật khẩu',
                'passwordagain.required' => 'Ban chưa nhập lại mật khẩu',
                'passwordagain.same' => 'Mật khẩu không giống nhau',
                'name.required' => 'Bạn chưa nhập họ tên',
                'diachi.required' => 'Bạn chưa nhạp địa chỉ',
                'sdt.required' => 'Ban chưa nhập sốd điên thoại',
            ]);
        $email = $this->request->email;
        $code = bcrypt(md5(rand(1, 99999)));
        $khachhang = new KhachHang();
        $khachhang->Email = $email;
        $khachhang->password = bcrypt($this->request->password);
        $khachhang->HoTen = $this->request->name;
        $khachhang->DiaChi = $this->request->diachi;
        $khachhang->SoDienThoai = $this->request->sdt;
        $khachhang->code = $code;

        $khachhang->save();

        //link
        $url = route('get.link.xacnhan', [
            'code' => $code,
            'email' => $email,
        ]);
        $data = [
            'route' => $url,
            'name' => $this->request->name,
        ];
        //gui mail
        Mail::send('frontend.email-template.guimail_xacnhan', $data, function ($message) use ($email) {
            $message->from('it.duonggiabao@gmail.com', 'Quản trị viên');
            $message->to($email, 'Xác nhận');
            $message->subject('Gửi mã xác nhận!');
        });

        if ($khachhang->id) {
            return redirect('dangky')->with('ThongBao', 'Link xác nhận đăng ký đã được gửi vào email của bạn');
        } else {
            return redirect()->back();
        }

    }

    public function getXacnhan()
    {
        $code = $this->request->code;
        $email = $this->request->email;

        // dd($code);
        $checkUser = KhachHang::where([
            'code' => $code,
            'Email' => $email,
        ])->first();

//        dd($checkUser);
        if (!$checkUser) {
            return redirect('xacnhan')->with('ThongBao', 'Xin lỗi đường dẫn không đúng!');
        }

        return view('frontend.subpage.xacnhandangky', ['code' => $code]);
    }

    public function postXacnhan(Request $request)
    {
        $xacnhan = $request->xacnhan;
        $khachhang = KhachHang::where('code', $xacnhan)->first();


        $khachhang->active = 1;

        $khachhang->save();

        return redirect('dangnhap')->with('ThongBao', 'Kích hoạt tài khoản thành công.Vui lòng đăng nhập');
    }

    public function getAccount()
    {
        $khachhang = KhachHang::find(Auth::guard('KhachHang')->id());

        return view('frontend.subpage.taikhoan', ['khachhang' => $khachhang]);
    }

    public function postAccount()
    {
        $this->validate($this->request,
            [
                'name' => 'required',
                'diachi' => 'required',
                'sdt' => 'required',
            ]
            , [
                'name.required' => 'Bạn chưa nhập tên',
                'diachi.required' => 'Bạn chưa nhập địa chỉ',
                'sdt.required' => 'Bạn chư nhập số điện thoại',
            ]);
        $khachhang = Auth::guard('KhachHang')->user();
        $khachhang->HoTen = $this->request->name;
        $khachhang->DiaChi = $this->request->diachi;
        $khachhang->SoDienThoai = $this->request->sdt;
        if ($this->request->checkpassword == 'on') {
            $this->validate($this->request,
                [
                    'passwordold' => 'required',
                    'password' => 'required',
                    'passwordagain' => 'required|same:password',
                ]
                , [
                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'passwordagain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordagain.same' => 'Mật khẩu không giống nhau',
                    'passwordold.required' => 'Bạn chưa nhập mật khẩu cũ',
                ]);

            $khachhang->password = bcrypt($this->request->password);

        }
        $khachhang->save();

        return redirect('taikhoan')->with('ThongBao', 'Cập nhập tài khoản thành công');
    }

    public function getCamon()
    {
        return view('frontend.subpage.camon');
    }

    //tim kiem
    public function getTimkiem()
    {
        $tukhoa = $this->request->tukhoa;
        $sanpham = SanPham::where('Ten', 'LIKE', '%'.$tukhoa.'%')->orWhere('TomTat', 'LIKE',
            '%'.$tukhoa.'%')->paginate(8);
        $sanpham->appends(['tukhoa' => $tukhoa]);

        // dd($tukhoa);
        return view('frontend.subpage.timkiem',
            [
                'sanpham' => $sanpham,
            ]);

    }

    //don hang cua ban
    public function danh_sach_don_hang($id)
    {
        $donhang = DonHang::where('idKH', $id)->get();

        return view('frontend.subpage.donhangcuaban', ['donhang' => $donhang]);

    }

    //chi tiet don hang
    public function getChitietdonhang()
    {
        $id = $this->request->id;
        $chitietdonhang = ChiTietDonHang::where('idDH', $id)->get();
        echo "<thead>
           <tr align='center'>
           <th>ID</th>
           <th>Tên</th>
           <th>Hình</th>
           <th>Số lượng</th>
           <th>Giá</th>
           <th>Imei</th>
           <th>% Giảm giá</th>
           </tr>
           </thead>";
        foreach ($chitietdonhang as $cthd) {
            $imei = explode('/', $cthd->IMEI);
            ?>
            <tr align='center'>
                <th><?= $cthd->id ?></th>
                <th><a href='chitietsanpham/"<?= $cthd->sanpham->id ?>'><?= $cthd->sanpham->Ten ?></a></th>
                <th><img width='70px' height='70px' src='upload/sanpham/<?= $cthd->sanpham->Hinh ?>'></th>
                <th><?= $cthd->SoLuong ?></th>
                <th><?= number_format($cthd->Gia, 0, ',', '.').'đ' ?></th>
                <th>
                    <?php $i = 1;
                    foreach ($imei as $vl) { ?>
                        <p><?= $i ?> :<?= $vl ?></p>
                        <?php $i++;
                    } ?>
                </th>
                <th>
                    <?php
                    if ($cthd->GiamGia != null) {
                        if ($cthd->TrangThai_KM == 1) {
                            echo $cthd->GiamGia;
                        } else {
                            $id = $cthd->GiamGia;
                            $sanpham = SanPham::find($id);
                            echo 'tặng'.' '.$sanpham->Ten;
                        }
                    } else {
                        echo 'No';
                    }
                    ?>
                </th>
            </tr>
            <?php
        }
    }

    //cho khach hang huy don hang khi don hang chua xu ly
    public function getHuydonhang($iddh)
    {
        $donhang = DonHang::find($iddh);
        //kiem tra thoi gian trong vong 12gio
        Carbon::setLocale('vi');
        $thoigiandonhang = $donhang->created_at;
        $now = Carbon::now();
        //tach chuoi thanh mang
//         dd($thoigiandonhang->diffInHours($now));
        $thoigian = explode(' ', ($thoigiandonhang->diffInHours($now)));
        // dd($thoigian[0]);
        if ($donhang->TrangThai == 0 && $thoigian[0] > 12) {
            return redirect()->back()->with('ThongBao', 'Sau 12 giờ đơn hàng không thể huỷ được');
        } else {
            $trangthai = 4;
        }
        $donhang->TrangThai = $trangthai;
        $donhang->save();

        return redirect()->back()->with('ThongBao', 'Huỷ đơn hàng thành công');

    }

    public function share_coupon()
    {
        $email = $this->request->email;
        $array_user = [];
        $session_email = Session::get('email');
        if ($session_email == true) {
            if (!in_array($email, $session_email)) {
                array_unshift($session_email, $email);
                Session::put('email', $session_email);
                $theloaikm = TheLoaiMaKhuyenMai::where('Code', 'COVID19')->first();
                $ngayapdung = $theloaikm->NgayApDung;
                $ngayketthuc = $theloaikm->NgayKetThuc;
                $makhuyenmai = MakhuyenMai::where('idTLMKM', $theloaikm->id)->get();
                foreach ($makhuyenmai as $makm) {
                    if ($makm->TrangThai == 0) {
                        $code = $makm->Code;
                        $data = [
                            'name' => $email,
                            'code' => $code,
                            'ngayapdung' => $ngayapdung,
                            'ngaykethuc' => $ngayketthuc,
                        ];
                        //gui mail
                        Mail::send('frontend.email-template.share_coupon', $data, function ($message) use ($email) {
                            $message->from('it.duonggiabao@gmail.com', 'Quản trị viên');
                            $message->to($email, 'Tặng mã khuyến mãi');
                            $message->subject('Tặng mã khuyến mãi!');
                        });
                        //update trang thai ma khuyen mai len 1
                        $coupon = MaKhuyenMai::where('Code', $code)->first();
                        $coupon->TrangThai = 1;
                        $coupon->save();
                        break;
                    }
                }
            }
        } else {
            $array_user[] = $email;
            Session::put('email', $array_user);
            $theloaikm = TheLoaiMaKhuyenMai::where('Code', 'COVID19')->first();
            $ngayapdung = $theloaikm->NgayApDung;
            $ngayketthuc = $theloaikm->NgayKetThuc;
            $makhuyenmai = MakhuyenMai::where('idTLMKM', $theloaikm->id)->get();
            foreach ($makhuyenmai as $makm) {
                if ($makm->TrangThai == 0) {
                    $code = $makm->Code;
                    $data = [
                        'name' => $email,
                        'code' => $code,
                        'ngayapdung' => $ngayapdung,
                        'ngaykethuc' => $ngayketthuc,
                    ];
                    //gui mail
                    Mail::send('frontend.email-template.share_coupon', $data, function ($message) use ($email) {
                        $message->from('it.duonggiabao@gmail.com', 'Quản trị viên');
                        $message->to($email, 'Tặng mã khuyến mãi');
                        $message->subject('Tặng mã khuyến mãi!');
                    });
                    //update trang thai ma khuyen mai len 1
                    $coupon = MaKhuyenMai::where('Code', $code)->first();
                    $coupon->TrangThai = 1;
                    $coupon->save();
                    break;
                }
            }
        }
        Session::save();

        return redirect()->back();
    }

}
