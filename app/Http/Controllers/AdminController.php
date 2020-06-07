<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\QuanTri;
use App\SanPham;
use App\DonHang;
use App\KhachHang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index(){
        $sanpham=SanPham::all();
        $donhang=DonHang::all();
        $tongtien=DonHang::where('TrangThai',3)->sum('TongTien');
        $khachhang=KhachHang::where('active',1)->get();

        $moneyDay=DonHang::whereDay('updated_at',date('d'))->where('TrangThai',3)->sum('TongTien');
        //danh thu thang
        $moneyMonth=DonHang::whereMonth('updated_at',date('m'))->where('TrangThai',3)->sum('TongTien');
        $month12=DonHang::whereMonth('updated_at',date('12'))->where('TrangThai',3)->sum('TongTien');
        $month11=DonHang::whereMonth('updated_at',date('11'))->where('TrangThai',3)->sum('TongTien');
        $month10=DonHang::whereMonth('updated_at',date('10'))->where('TrangThai',3)->sum('TongTien');
        $month9=DonHang::whereMonth('updated_at',date('9'))->where('TrangThai',3)->sum('TongTien');
        $month8=DonHang::whereMonth('updated_at',date('8'))->where('TrangThai',3)->sum('TongTien');
        $month7=DonHang::whereMonth('updated_at',date('7'))->where('TrangThai',3)->sum('TongTien');
        $month6=DonHang::whereMonth('updated_at',date('6'))->where('TrangThai',3)->sum('TongTien');
        $month5=DonHang::whereMonth('updated_at',date('5'))->where('TrangThai',3)->sum('TongTien');
        $month4=DonHang::whereMonth('updated_at',date('4'))->where('TrangThai',3)->sum('TongTien');
        $month3=DonHang::whereMonth('updated_at',date('3'))->where('TrangThai',3)->sum('TongTien');
        $month2=DonHang::whereMonth('updated_at',date('2'))->where('TrangThai',3)->sum('TongTien');
        $month1=DonHang::whereMonth('updated_at',date('1'))->where('TrangThai',3)->sum('TongTien');
        //end danh thu thang
        $moneyWeek=DonHang::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('TrangThai',3)->sum('TongTien');
        $moneyYear=DonHang::whereYear('updated_at',date('Y'))->where('TrangThai',3)->sum('TongTien');
        $donhang_new=DonHang::orderByRaw('id DESC')->where('TrangThai',0)->paginate(10);

        $chiTiet =DB::select('select idSP,sum(SoLuong)as TongSL from ChiTietDonHang join DonHang on ChiTietDonHang.idDH=DonHang.id where MONTH(ChiTietDonHang.updated_at)=MONTH(NOW()) and DonHang.TrangThai=3  group By idSP ');

        $dataProduct=[];
        foreach($chiTiet as $chitiet){
            $soluong=$chitiet->TongSL;
            $idsp=$chitiet->idSP;
            $sp=SanPham::where('id',$idsp)->get();
            foreach ($sp as $value) {

                $dataProduct[]=[
                    "name"  =>$value->Ten ,
                    "y"  => (int)$soluong,
                ];
            }

        }

        $dataMoney=[
            [
                "name" => "Doanh thu ngày",
                "y"    => (int)$moneyDay,
            ],
            [
                "name" => "Doanh thu tuần",
                "y"    => (int)$moneyWeek,
            ],
            [
                "name"     => "Doanh thu tháng",
                "y"        => (int)$moneyMonth,
                "drilldown"=>"Doanh thu tháng"
            ],
            [
                "name" => "Doanh thu năm",
                "y"    => (int)$moneyYear,
            ],
        ];
        $dataChitiet=[
            [
                "tháng 12",
                (int)$month12
            ],
            [
                "tháng 11",
                (int)$month11
            ],
            [
                "tháng 10",
                (int)$month10
            ],
            [
                "tháng 9",
                (int)$month9
            ],
            [
                "tháng 8",
                (int)$month8
            ],
            [
                "tháng 7",
                (int)$month7
            ],
            [
                "tháng 6",
                (int)$month6
            ],
            [
                "tháng 5",
                (int)$month5
            ],
            [
                "tháng 4",
                (int)$month4
            ],
            [
                "tháng 3",
                (int)$month3
            ],
            [
                "tháng 2",
                (int)$month2
            ],
            [
                "tháng 1",
                (int)$month1
            ],

        ];
        return view('admin.index',
            [
                'sanpham'		=>$sanpham,
                'donhang'		=>$donhang,
                'tongtien'		=>$tongtien,
                'khachhang'     =>$khachhang,
                'moneyDay'      =>$moneyDay,
                'moneyMonth'    =>$moneyMonth,
                'dataMoney'     =>json_encode($dataMoney),
                'dataProduct'   =>json_encode($dataProduct),
                'dataChitiet'   =>json_encode($dataChitiet),
                'donhang_new'   =>$donhang_new,
            ]);
    }
    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(){
        $this->validate($this->request,
            [
                'email'             =>'required',
                'password'          =>'required',
            ]
            ,[
                'email.required'    =>'Ban chua nhap email',
                'password.required' =>'Ban chua nhap password',
            ]);
//        $data=$this->request->only(['email','password']);
        if(Auth::guard('QuanTri')->attempt(['Email'=>$this->request->email,'password'=>$this->request->password])){
            return redirect('admin/trangchu');
        }else{
            return redirect()->back();
        }
    }
    public function getLogout(){
        Auth::guard('QuanTri')->logout();
        return redirect('admin/dangnhap');

    }
}
