<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SanPham;
use App\BinhLuan;
use App\ChiTietKhuyenMai;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    //
    public function getComment(){
        $idsp=$_GET['idsp'];
        $noidung=$_GET['noidung'];
        $idKH=Auth::guard('KhachHang')->id();
        $idQT=2;

        $binhluan=new BinhLuan();
        $binhluan->NoiDung=$noidung;
        $binhluan->idKH=$idKH;
        $binhluan->idQT=$idQT;
        $binhluan->idSP=$idsp;

        $binhluan->save();
        if($binhluan) {
            $hoten = $binhluan->khachhang->HoTen;
            $noidung = $binhluan->NoiDung;
            $thoigian = $binhluan->created_at;
        }
        echo "<li class'review'>
		<div class='thumb'>
		<img src='images/images.png' alt='Image'>
		</div>
		<div class='text-wrap'>
		<div class='review-text'>
		<h2>".$hoten."</h2>
		<p>".$noidung."</p>
		<p>Thời gian: ".$thoigian."</p>
		</div>
		</div>
		</li>";
    }
    public function postProductview($id){
        $listid=explode(',',$id);
        $sanphamview=SanPham::whereIn('id',$listid)->orderByRaw('id','desc')->limit(5)->get();

        return view('frontend.subpage.productview',
            [
                'sanphamview'   =>$sanphamview,
                'id'            =>$id,
            ]
        );
//        $html=view('frontend.subpage.productview',compact('sanphamview','id'))->render();
//        return response($html);
    }
    //kiem tra mat khau cu
    public function getKiemtramatkhau(){
        $pass=$this->request->pass;
        if(!(Hash::check($pass,Auth::guard('KhachHang')->user()->password))){
            echo "Mat khau cu khong dung";
        }
    }
    public function postTimkiem(){
        $tukhoa=$this->request->tukhoa;
        $sanpham=SanPham::where('Ten','LIKE',"%{$tukhoa}%")->orWhere('TomTat','LIKE',"%{$tukhoa}%")->take(5)->get();

        $ouput='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		';

        foreach ($sanpham as $sp) {
            $ouput.='
					<div class="row">
					<div class="col-sm-5 col-xs-5">
					<img src="upload/sanpham/'.$sp->Hinh.'" />
					</div>
					<div class="col-sm-7 col-xs-7">
					<div style="font-size: 15px;">
					<a style="width:80px" href="chitietsanpham/'.$sp->id.'/'.$sp->Ten_KhongDau.'.html">'.$sp->Ten.'</a>
					</div>

					</div>

					</div>';
        }

        $ouput.='</div>
			';
        echo $ouput;

    }
    public function postChitietkhuyenmai(){
        $id=$this->request->id;
        $chitietkhuyenmai=ChiTietKhuyenMai::where('idKM',$id)->get();
        echo   "<thead>
                   <tr align='center'>
                   <th>ID</th>
                   <th>Tên</th>
                    <th>Hình</th>
                   <th>Gia_Sale</th>
                   <th>Chi tiết</th>
                   </tr>
                 </thead>";
        foreach ($chitietkhuyenmai as $ctkm) {
            echo    "<tr align='center'>
                         <th>".$ctkm->id."</th>
                         <th><a href='chitietsanpham/".$ctkm->sanpham->id."'>".$ctkm->sanpham->Ten."</a></th>
                         <th><img width='70px' height='70px' src='upload/sanpham/".$ctkm->sanpham->Hinh."' ></th>
                         <th>".$ctkm->Gia_Sale."</th>
                         <th>".$ctkm->ChiTiet."</th>
                         </tr>";
                 }
    }

}
