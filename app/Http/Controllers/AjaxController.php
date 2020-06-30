<?php

namespace App\Http\Controllers;

use App\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SanPham;
use App\BoLoc;
use App\BinhLuan;
use App\ChiTietKhuyenMai;
use App\MakhuyenMai;
use App\TheLoai;
use App\ChiTietDonHang;
use App\TheLoaiMaKhuyenMai;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    //
    public function getComment(){
        $idsp=$_GET['idsp'];
        $noidung=$_GET['noidung'];
        $parent_id=$_GET['parent_id'];
        $idKH=Auth::guard('KhachHang')->id();
        $idQT=2;

        $binhluan=new BinhLuan();
        $binhluan->NoiDung=$noidung;
        $binhluan->idKH=$idKH;
        $binhluan->idQT=$idQT;
        $binhluan->idSP=$idsp;
        $binhluan->parent_id=$parent_id;

        $binhluan->save();
        if($binhluan) {
            $id=$binhluan->id;
            if ($binhluan->TrangThai_Admin==0) {
                $hoten = $binhluan->khachhang->HoTen;
            }else{
                $hoten = $binhluan->quantri->HoTen;
            }
            $noidung = $binhluan->NoiDung;
            $thoigian = $binhluan->created_at;
        }
        echo "
		<div class='thumb'>
		    <img src='images/images.png' alt='Image'>
		</div>
		<div class='text-wrap'>
		    <div class='review-text'>
		        <h2>".$hoten."</h2>
		        <p>".$noidung."</p>
		        <p>Thời gian: ".$thoigian."</p>
		    </div>
		</div>";
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
    public function postMakhuyenmai(){
        $id=$this->request->id;
        $makhuyenmai=MakhuyenMai::where('idTLMKM',$id)->get();
        echo   "<thead>
                   <tr align='center'>
                   <th>STT</th>
                   <th>Code</th>
                   <th>Trạng Thái</th>
                   <th>Thể Loại Mã Khuyến Mãi</th>
                   </tr>
                 </thead>";
        foreach ($makhuyenmai as $key=> $makm) {
                $trangthai='';
                if ($makm->TrangThai==0){
                    $trangthai.='Có thể phát mã';
                }elseif($makm->TrangThai==1){
                    $trangthai.='Chưa sử dụng';
                }else{
                    $trangthai.='Đã sử dụng';
                }
                $classes='';
                if ($makm->TrangThai==0){
                    $classes.='btn-primary';
                }elseif($makm->TrangThai==1){
                    $classes.='btn-info';
                }else{
                    $classes.='btn-danger';
                }
            echo    "<tr align='center'>
                         <th>".($key+1)."</th>
                         <th>".$makm->Code."</th>
                         <th> <a class='btn btn-xs $classes'>".$trangthai."</a></th>
                         <th>".$makm->theloaimakhuyenmai->Ten."</th>
                         </tr>";
        }
    }
    public function postShowthuoctinh(){
        $id=$this->request->id;
        $theloai=TheLoai::find($id);
        $thuoctinh=$theloai->thuoctinh;
        echo $data=json_encode($thuoctinh);
    }
    public function chitietdonhang(){
        $id=$this->request->id;
        $chitietdonhang=ChiTietDonHang::where('idDH',$id)->get();
        $donhang=DonHang::find($id);
        echo "<h2 class='text-center'>Thông tin vận chuyển</h2>
                <table class='table table-striped table-bordered table-hover '>
                   <thead>
                       <tr align='center'>
                       <th>Tên người nhận</th>
                       <th width='230px'>Địa chỉ</th>
                       <th>Số điện thoại</th>
                       <th width='200px'>Ghi chú</th>
                       </tr>
                  </thead>";
                ?>
                     <tr align='center'>
                     <th>
                        <?php
                            if ($donhang->HoTen==null){
                                echo $donhang->khachhang->HoTen;
                            }else{
                                echo "Tên 1: ".$donhang->HoTen."<br/>";
                                echo "Tên 2: ".$donhang->khachhang->HoTen;
                            }
                        ?>
                     </th>
                    <th>
                        <?php
                            if ($donhang->DiaChi==null){
                                echo $donhang->khachhang->DiaChi;
                            }else{
                                echo "Địa chỉ 1: ".$donhang->DiaChi."<br/>";
                                echo "Địa chỉ 2: ".$donhang->khachhang->DiaChi;
                            }
                        ?>
                    </th>
                    <th>
                        <?php
                            if ($donhang->SoDienThoai==null){
                                echo $donhang->khachhang->SoDienThoai;
                            }else{
                                echo "Số điện thoại 1: ".$donhang->SoDienThoai."<br/>";
                                echo "Số điện thoại 2: ".$donhang->khachhang->SoDienThoai;
                            }
                        ?>
                    </th>
                    <th>
                        <?php echo $donhang->GhiChu?>
                    </th>
                    </tr>
                <?php

        echo "</table>";
        //
         echo "<h2 class='text-center'>Chi tiết đơn hàng</h2>
                <table class='table table-striped table-bordered table-hover '>
                   <thead>
                       <tr align='center'>
                       <th>STT</th>
                       <th>Tên</th>
                       <th>Hình</th>
                       <th>Số lượng</th>
                       <th>Giá</th>
                       <th>IMEI</th>
                       <th width='100px'>% giảm giá hoặc tặng sản phẩm </th>
                       <th>Update</th>
                       </tr>
                  </thead>";
        foreach ($chitietdonhang as $key => $cthd) {
            $imei=explode('/', $cthd->IMEI);
            ?>
            <tr align='center'>
                <th><?= $key+1; ?></th>
                <th><a href='chitietsanpham/<?=$cthd->sanpham->id ?>'><?=$cthd->sanpham->Ten?></a></th>
                <th><img width='70px' height='70px' src='upload/sanpham/<?=$cthd->sanpham->Hinh?>' ></th>
                <th><?=$cthd->SoLuong?></th>
                <th>
                    <?=number_format($cthd->Gia,0,',','.').'đ'?>
                    <br>
                    <?php if($cthd->Gia==0){
                        echo "( Sản phẩm tặng kèm khuyến mãi)";
                    } ?>
                </th>
                <th >
                    <?php $i=1; foreach($imei as $vl){ ?>
                        <p><?=$i?>:<?=$vl?></p>
                        <?php $i++;} ?>
                </th>
                <th>
                    <?php
                    if ($cthd->GiamGia!=null) {
                        if ($cthd->TrangThai_KM == 1) {
                            echo $cthd->GiamGia;
                        } else {
                            $id = $cthd->GiamGia;
                            $sanpham = SanPham::find($id);
                            echo 'tặng' . ' ' . $sanpham->Ten;
                        }
                    }
                    else{
                            echo 'No';
                    }
                    ?>
                </th>
                <th><a href='admin/donhang/xuly/<?=$cthd->id?>'>Sửa</th>
            </tr>
            <?php
        }
        ?>
            <tr>
                <th colspan='2'>
                    Tổng:
                    <br>
                    Khuyến mãi:
                    <br>
                    <br>
                    Giảm giá:
                    <br>
                    Phí ship:
                    <br>
                    Thanh toán:
                </th>
                <th colspan="6">
                    <?php echo number_format($donhang->TongTien,0,',','.').'đ';?>
                    <br>
                    <?php
                         $sum_sale=0;
                         $name_sale=null;
                         foreach ($chitietdonhang as $cthd1) {
                             if($cthd1->GiamGia!=null) {
                                 if ($cthd1->TrangThai_KM==2){
                                     $khuyenmai = $cthd1->GiamGia;
                                     $sanpham=SanPham::find($khuyenmai);
                                     $name_sale='tặng'.' '.$sanpham->Ten;
                                 }else {
                                     $khuyenmai = $cthd1->GiamGia;
                                     $price = $cthd1->sanpham->Gia * $cthd1->SoLuong;
                                     $price_sale = ($price * $khuyenmai / 100);
                                     $sum_sale += $price_sale;
                                 }
                             }

                         }
                    ?>
                    <?php echo number_format(-$sum_sale,0,',','.').'đ'.'</br>'.$name_sale;?>
                    <br>
                    <?php
                        $sum_coupon=0;
                        if($donhang->idMaKM!=0){
                            $idkm=$donhang->idMaKM;
                            $makm=MakhuyenMai::find($idkm);
                            $sotien_giamgia=$makm->theloaimakhuyenmai->GiaTri;
                            $sum_coupon=$sotien_giamgia;
                        }
                    ?>
                    <?php echo number_format(-$sum_coupon,0,',','.').'đ'; ?>
                    <br>
                   <?php echo 'free';?>
                    <br>
                   <?php echo number_format($donhang->TongTien_DaGiam,0,',','.').'đ';?>
                </th>
            </tr>
            <tr>
                <th colspan="8">
                    <button class="btn btn-primary button"><a href="admin/donhang/print-order/<?= $id; ?>">in hoá đơn</a></button>
                </th>
            </tr>
        <?php

        echo "</table>";
    }
    public function product_filter(){
        $arr_value=$this->request->arr_value;
        if(count($arr_value)>0) {
            if (count($arr_value) == 1) {
                $products = SanPham::whereHas('boloc', function ($query) use ($arr_value) {
                    $query->whereIn('idBL', $arr_value);
                })->paginate(8);
            } else {
                $products = SanPham::whereHas('boloc', function ($query) use ($arr_value) {
                    $query->whereIn('idBL', $arr_value);
                    $query->groupBy('idSP');
                    $query->havingRaw('COUNT(idSP)>=2');
                })->paginate(8);
            }
        }
        echo json_encode($products);
    }
    public function sosanh_sanpham(){
        $arr_id=$this->request->id;
        $sanpham=SanPham::whereIn('id',$arr_id)->get();
        echo   "<thead>
                   <tr align='center'>";
            foreach ($sanpham as $sp1) {
                  echo "<th style='font-weight: bold'>$sp1->Ten</th>";
                   }
             echo "</tr>
                 </thead>";
            echo  "<tr>";
            foreach ($sanpham as $sp){
                echo  "<td width='50%'>
                    <div class='table-wrapper-scroll-y table-responsive custom-scrollbar-css'>
                       <table class='table table-fixed'>
                           <thead>";
                            foreach ($sp->chitietthuoctinh as $tt) {
                                echo "<tr>
                                       <th>" . $tt->thuoctinh->Ten . "</th>
                                       <th>" . $tt->ChiTiet . "</th>
                                     </tr>";
                            }
                     echo "</thead>
                       </table>
                       </div>
                    </td>";
                }
            echo "</tr>";
    }
}
