<?php

namespace App\Http\Controllers;

use App\ChiTietPhieu;
use App\DanhMucSanPham;
use App\Events\NotiWarrantly;
use App\GiaLinhKien;
use App\PhieuBaoHanh;
use App\PhieuTrungTam;
use App\ThongTinBaoHanh;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;

class PhieuBaoHanhController extends Controller
{
    public function getList(){
        $phieubaohanh = PhieuBaoHanh::all();
        return view('admin.phieubaohanh.danhsach',['phieubaohanh'=>$phieubaohanh]);
    }
    public function search(){
        $keyword='';
        $where=[];
        if ($this->request->has('keyword')) {
            $keyword = $this->request->keyword;
            if($keyword!=null) {
                $where['IMEI'] = $keyword;
            }
        }
        if ($this->request->has('date')) {
            $date = $this->request->date;
            $date1 = explode(' - ', $date);
            $date_start = date('Y-m-d', strtotime($date1[0]));
            $date_end = date('Y-m-d', strtotime($date1[1]));
        }
            $phieubaohanh = PhieuBaoHanh::where([
              [$where],
              ['NgayNhan','>=',$date_start],
              ['NgayTraDuKien','<=',$date_end],
            ])->get();
            return view('admin.phieubaohanh.danhsach',
                [
                    'phieubaohanh'=>$phieubaohanh,
                    'keyword'=>$keyword,
                    'date'  =>$date
                ]);
    }
    public function danhsach_trungtam(){
        $phieubaohanh = PhieuBaoHanh::whereHas('phieutrungtam', function ($query)  {
        })->get();
        return view('admin.phieubaohanh.danhsach_trungtam',['phieubaohanh'=>$phieubaohanh]);
    }
    public function getAdd(){
        $danhmucsanpham=DanhMucSanPham::all();
        return view('admin.phieubaohanh.them',['danhmucsanpham'=>$danhmucsanpham]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'imei'                  =>'required',
                'tinhtrang'             =>'required',
                'ngaynhan'              =>'required',
                'ngaytra'               =>'required',
                'dichvu'                =>'required',
                'hoten'                 =>'required',
                'sdt'                   =>'required',
                'diachi'                =>'required',
            ],
            [
                'imei.required'         =>'Bạn chưa nhập imei',
                'tinhtrang.required'    =>'Bạn chưa nhập tình trạng',
                'ngaynhan.required'     =>'Bạn chưa chọn ngày nhận',
                'ngaytra.required'      =>'Bạn chưa chọn ngày trả',
                'dichvu.required'       =>'Bạn chưa chọn dịch vụ',
                'hoten.required'        =>'Bạn chưa nhập họ tên',
                'sdt.required'          =>'Bạn chưa nhập số điện thoại',
                'diachi.required'       =>'Bạn chưa nhập địa chỉ',
            ]
        );
        $session_dichvu = Session::get('dichvu');
        $tongtien=0;
        foreach ($session_dichvu as $dv1){
            $tongtien+=$dv1['price'];
        }
        $arr1 = explode ("/", $this->request->ngaynhan);
        if (count($arr1)==3) $this->request->ngaynhan = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngaynhan = date("Y-m-d");

        $arr = explode ("/", $this->request->ngaytra);
        if (count($arr)==3) $this->request->ngaytra = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngaytra = date("Y-m-d");

        $idsp=$this->request->tensanpham;
        $dmsanpham=DanhMucSanPham::find($idsp);
        $phieubaohanh=new PhieuBaoHanh();
        $phieubaohanh->TenSanPham       =$dmsanpham->Ten;
        $phieubaohanh->IMEI             =$this->request->imei;
        $phieubaohanh->TinhTrang        =$this->request->tinhtrang;
        $phieubaohanh->TongTien         =$tongtien;
        $phieubaohanh->HoTen            =$this->request->hoten;
        $phieubaohanh->SoDienThoai      =$this->request->sdt;
        $phieubaohanh->DiaChi           =$this->request->diachi;
        $phieubaohanh->NgayNhan         =$this->request->ngaynhan;
        $phieubaohanh->NgayTraDuKien    =$this->request->ngaytra;
        $phieubaohanh->idQT             =Auth::guard('QuanTri')->id();
        $phieubaohanh->save();
        if ($phieubaohanh){
            $idpbh=$phieubaohanh->id;
            foreach ($session_dichvu as $dv){
                ChiTietPhieu::insert([
                    'SoLuong'		=>1,
                    'Gia'           =>$dv['price'],
                    'LoaiDichVu'    =>$dv['service'],
                    'idGLK'			=>$dv['id'],
                    'idPBH'         =>$idpbh,
                ]);
            }
        }
        return redirect('admin/phieubaohanh/danhsach')->with('ThongBao','Thêm thành công');
    }
//    public function ajax_tinhphi(){
//        if ($this->request->has('id')) {
//            $arr_id = $this->request->id;
//        }
//        if ($this->request->has('imei')) {
//            $imei = $this->request->imei;
//            $thongtinbaohanh = ThongTinBaoHanh::where('IMEI', $imei)->first();
//            $ngayapdung = $thongtinbaohanh->NgayApDung;
//            $ngayketthuc=$thongtinbaohanh->NgayKetThuc;
//            }
//        Carbon::setLocale('vi');
//        $now=Carbon::now();
//        $ngay=$now->toDateString();
//        $output = '';
//        if ($arr_id!=null) {
//            $gialinhkien = GiaLinhKien::whereIn('id', $arr_id)->get();
//            $sum = 0;
//            foreach ($gialinhkien as $key => $value) {
//                $stt = $key + 1;
//                $gia = number_format($value->Gia_Sua, 0) . 'đ';
//                $output .= "<tr id='gia_parent$value->id'>
//                   <td>$stt</td>
//                   <td>$value->Ten_LinhKien</td>
//                   <td>
//                        <select class='form-control loaidichvu' name='loaidichvu[]' id='loaidichvu' data-key='$value->id'>";
//                if ($ngayapdung <= $ngay && $ngay <= $ngayketthuc) {
//                    $output .= "<option value='-1'>chọn dịch vụ</option>
//                                          <option value='1'>Sửa bảo hành</option>
//                                          <option value='2'>Sửa dịch vụ</option>";
//                } else {
//                    $output .= "<option value='-1'>chọn dịch vụ</option>
//                                          <option value='2'>Sửa dịch vụ</option>";
//                }
//                $output .= "</select>
//                   </td>
//                   <td id='gia_child$value->id' data-gia='$value->Gia_Sua'>$gia</td>
//            </tr>";
//                $sum += $value->Gia_Sua;
//            }
//            $sum1 = number_format($sum, 0) . 'đ';
//            $output .= "<tr id='sum-parent'>
//                <td colspan='3' class='text-right' style='font-weight: bold'>Tổng chi phí dự kiến</td>
//                <td id='sum-child' data-sum='$sum'>$sum1</td>
//            </tr>
//            <input type='hidden' name='sum' value='$sum'>
//            ";
//        }else{
//            $output.='error';
//        }
//        echo $output;
//    }
    public function ajax_tinhphi(){
        if ($this->request->has('id')) {
            $arr_id = $this->request->id;
        }
        if ($this->request->has('imei')) {
            $imei = $this->request->imei;
        }
        $output = '';
        if ($arr_id!=null) {
            $gialinhkien = GiaLinhKien::whereIn('id', $arr_id)->get();
            foreach ($gialinhkien as $glk) {
                $session_dichvu = Session::get('dichvu');
                if ($session_dichvu == true) {
                    $dichvu[] = array(
                        'session_id'    =>str_random(6),
                        'id'            =>$glk->id,
                        'name'          =>$glk->Ten_LinhKien,
                        'price'         =>$glk->Gia_Sua,
                        'service'       =>null,
                    );
                    Session::put('dichvu',$dichvu);
                }else{
                    $dichvu[] = array(
                        'session_id'    =>str_random(6),
                        'id'            =>$glk->id,
                        'name'          =>$glk->Ten_LinhKien,
                        'price'         =>$glk->Gia_Sua,
                        'service'       =>null,
                    );
                    Session::put('dichvu',$dichvu);
                }
                Session::save();
            }
            $this->show_dichvu($imei);
        }else{
            $output.='error';
        }
        echo $output;
    }
    public function show_dichvu($imei){
        $thongtinbaohanh = ThongTinBaoHanh::where('IMEI', $imei)->first();
        $ngayapdung = $thongtinbaohanh->NgayApDung;
        $ngayketthuc=$thongtinbaohanh->NgayKetThuc;

        //
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        $output = '';
        $sum = 0;
        $session_dichvu = Session::get('dichvu');
        foreach ($session_dichvu as $key => $value) {
                $stt = $key + 1;
                $gia = number_format($value['price'], 0) . 'đ';
                $id=$value['id'];
                $price=$value['price'];
                $name=$value['name'];
                $output .= "<tr id='gia_parent$id'>
                   <td>$stt</td>
                   <td>$name</td>
                   <td>
                        <select class='form-control loaidichvu' name='loaidichvu[]' id='loaidichvu' data-key='$id'>";
                if ($ngayapdung <= $ngay && $ngay <= $ngayketthuc) {
                    $output .= "<option value='-1'>chọn dịch vụ</option>
                                          <option value='1-$id'>Sửa bảo hành</option>
                                          <option value='2-$id'>Sửa dịch vụ</option>";
                } else {
                    $output .= "<option value='-1'>chọn dịch vụ</option>
                                          <option value='2-$id'>Sửa dịch vụ</option>";
                }
                $output .= "</select>
                   </td>
                   <td id='gia_child$id' data-gia='$price'>$gia</td>
            </tr>";
                $sum += $price;
            }
            $sum1 = number_format($sum, 0) . 'đ';
            $output .= "<tr id='sum-parent'>
                <td colspan='3' class='text-right' style='font-weight: bold'>Tổng chi phí dự kiến</td>
                <td id='sum-child' data-sum='$sum'>$sum1</td>
            </tr>
            <input type='hidden' name='sum'  value='$sum'>
            ";
            echo $output;
    }
    public function ajax_dichvu(){
        $id=$this->request->id;
        $danhmucsanpham=DanhMucSanPham::find($id);
        $dichvu=GiaLinhKien::where('idDMSP',$id)->get();
        $output="";
        foreach ($dichvu as $dv){
            $gia=number_format($dv->Gia_Sua,0,',','.').'đ';
            $output.="<option value='$dv->id'>$dv->Ten_LinhKien-$danhmucsanpham->Ten-(Giá : $gia)</option>";
            }
        echo $output;
    }
    public function ajax_check_imei(){
        $imei=$this->request->imei;
        $thongtinbaohanh = ThongTinBaoHanh::where('IMEI', $imei)->first();
        if (!$thongtinbaohanh){
           echo 1;
        }
    }
    public function ajax_update_dichvu(){
        $id=$this->request->id;
        $imei=$this->request->imei;
        $id=explode("-",$id);
        $session_dichvu = Session::get('dichvu');
        if ($id[0]==1){
            foreach ($session_dichvu as &$dichvu){
                if ($id[1]==$dichvu['id']){
                    $dichvu['service']=$id[0];
                    $dichvu['price']=0;
                }
            }
            Session::put('dichvu', $session_dichvu);
        }
        if($id[0]==2){
            foreach ($session_dichvu as &$dichvu){
                if ($id[1]==$dichvu['id']){
                    $dichvu['service']=$id[0];
                    $linhkien=GiaLinhKien::find($dichvu['id']);
                    $dichvu['price']=$linhkien->Gia_Sua;
                }
            }
            Session::put('dichvu', $session_dichvu);
        }
        Session::save();
        $sum=0;
        $data=[];
        foreach ($session_dichvu as $dv){
            $sum+=$dv['price'];
            if ($dv['id']==$id[1]){
                $data['gia']=$dv['price'];
            }
            $data['sum']=$sum;
        }
        echo json_encode($data);
    }
    public function show_chitiet_baohanh(){
        $id=$this->request->id;
        $phieubaohanh=PhieuBaoHanh::find($id);
        $dt = Carbon::create($phieubaohanh->NgayNhan);
        $dt1 = Carbon::create($phieubaohanh->NgayTraDuKien);
        $dukien=$dt->diffInDays($dt1);
        $output='';
        $output.="<div class='row'>
                     <div class='col-lg-6'>
                        <h2 style='font-weight: bold'>Dịch vụ sửa chữa</h2>
                        <table class='table table-bordered'>
                              <thead>
                                  <tr>
                                       <th>STT</th>
                                       <th>Dịch vụ sửa chữa</th>
                                       <th>Loại dịch vụ</th>
                                       <th>Giá tiền</th>
                                  </tr>
                              </thead>
                              <tbody>";
                                    foreach ($phieubaohanh->chitietphieu as $key=> $ctp){
                                        $ten=$ctp->gialinhkien->Ten_LinhKien;
                                        $stt=$key+1;
                                        $gia=number_format($ctp->Gia,0,',','.').'đ';
                                        $sum=number_format($phieubaohanh->TongTien,0,',','.').'đ';
                                        $loaidichvu=$ctp->LoaiDichVu==1?'sửa bảo hành':'sửa dịch vụ';
                                        $output.="<tr>
                                          <td>$stt</td>
                                          <td>$ten</td>
                                          <td>$loaidichvu</td>
                                          <td>$gia</td>
                                        </tr>";
                                    }
                                    $output.="<tr>
                                        <td colspan='3' class='text-right'>Tổng tiền</td>
                                        <td>$sum</td>
                                    </tr>";
                    $output.="</tbody>
                         </table>
                        </div>
                        <div class='col-lg-6'>
                        <h2 style='font-weight: bold'>Thông tin sản phẩm</h2>
                         <table class='table table-bordered'>
                              <thead>
                                  <tr>
                                       <th>Tên sản phẩm</th>
                                       <td>$phieubaohanh->TenSanPham</td>
                                  </tr>
                                   <tr>
                                       <th>Số IMEI</th>
                                       <td>$phieubaohanh->IMEI</td>
                                  </tr>
                                   <tr>
                                       <th>Tình trạng</th>
                                       <td>$phieubaohanh->TinhTrang</td>
                                  </tr>
                                   <tr>
                                       <th>Dự kiến hoàn thành</th>
                                       <td>$dukien Ngày</td>
                                  </tr>
                              </thead>
                          </table>
                        <br>
                        <h2>Thông tin tiếp nhận</h2> <table class='table table-bordered'>
                              <thead>
                                  <tr>
                                       <th>Tên khách hàng</th>
                                       <td>$phieubaohanh->HoTen</td>
                                  </tr>
                                   <tr>
                                       <th>Số điện thoại</th>
                                       <td>$phieubaohanh->SoDienThoai</td>
                                  </tr>
                                   <tr>
                                       <th>Địa chỉ</th>
                                       <td>$phieubaohanh->DiaChi</td>
                                  </tr>

                              </thead>
                          </table>
                        </div>
                  </div>";

        echo $output;
    }
    public function getEdit($id){
        $danhmucsanpham=DanhMucSanPham::all();
        $phieubh=PhieuBaoHanh::find($id);
        $dmsp=DanhMucSanPham::where('Ten',$phieubh->TenSanPham)->first();
        $dmsp_ct=DanhMucSanPham::find($dmsp->id);
        return view('admin.phieubaohanh.sua',
            [
                'danhmucsanpham'=>$danhmucsanpham,
                'phieubh'       =>$phieubh,
                'dmsp_old'      =>$dmsp,
                'dmsp_ct'       =>$dmsp_ct,
            ]);
    }
    public function postEdit($id){
        $this->validate($this->request,
            [
                'imei'                  =>'required',
                'tinhtrang'             =>'required',
                'ngaynhan'              =>'required',
                'ngaytra'               =>'required',
                'dichvu'                =>'required',
                'hoten'                 =>'required',
                'sdt'                   =>'required',
                'diachi'                =>'required',
            ],
            [
                'imei.required'         =>'Bạn chưa nhập imei',
                'tinhtrang.required'    =>'Bạn chưa nhập tình trạng',
                'ngaynhan.required'     =>'Bạn chưa chọn ngày nhận',
                'ngaytra.required'      =>'Bạn chưa chọn ngày trả',
                'dichvu.required'       =>'Bạn chưa chọn dịch vụ',
                'hoten.required'        =>'Bạn chưa nhập họ tên',
                'sdt.required'          =>'Bạn chưa nhập số điện thoại',
                'diachi.required'       =>'Bạn chưa nhập địa chỉ',
            ]
        );

        $session_dichvu = Session::get('dichvu');
        $tongtien=0;
        foreach ($session_dichvu as $dv1){
            $tongtien+=$dv1['price'];
        }
        $arr1 = explode ("/", $this->request->ngaynhan);
        if (count($arr1)==3) $this->request->ngaynhan = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngaynhan = date("Y-m-d");

        $arr = explode ("/", $this->request->ngaytra);
        if (count($arr)==3) $this->request->ngaytra = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngaytra = date("Y-m-d");

        $idsp=$this->request->tensanpham;
        $dmsanpham=DanhMucSanPham::find($idsp);
        $phieubaohanh=PhieuBaoHanh::find($id);
        $phieubaohanh->TenSanPham       =$dmsanpham->Ten;
        $phieubaohanh->IMEI             =$this->request->imei;
        $phieubaohanh->TinhTrang        =$this->request->tinhtrang;
        $phieubaohanh->TongTien         =$tongtien;
        $phieubaohanh->HoTen            =$this->request->hoten;
        $phieubaohanh->SoDienThoai      =$this->request->sdt;
        $phieubaohanh->DiaChi           =$this->request->diachi;
        $phieubaohanh->NgayNhan         =$this->request->ngaynhan;
        $phieubaohanh->NgayTraDuKien    =$this->request->ngaytra;
        $phieubaohanh->idQT             =Auth::guard('QuanTri')->id();
        $phieubaohanh->save();
        if ($phieubaohanh){
            $idpbh=$phieubaohanh->id;
            $phieubaohanh->chitietphieu()->delete();
            foreach ($session_dichvu as $dv){
                ChiTietPhieu::insert([
                    'SoLuong'		=>1,
                    'Gia'           =>$dv['price'],
                    'LoaiDichVu'    =>$dv['service'],
                    'idGLK'			=>$dv['id'],
                    'idPBH'         =>$idpbh,
                ]);
            }
        }
        return redirect('admin/phieubaohanh/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function chuyentrungtam(){
        $id=$this->request->id;
        $arr1 = explode ("/", $this->request->ngaygui);
        if (count($arr1)==3) $this->request->ngaygui = $arr1[2]."-".$arr1[0]."-".$arr1[1];
        else $this->request->ngaygui = date("Y-m-d");

        $arr = explode ("/", $this->request->ngaytra);
        if (count($arr)==3) $this->request->ngaytra = $arr[2]."-".$arr[0]."-".$arr[1];
        else $this->request->ngaytra = date("Y-m-d");

        $phieubaohanh=PhieuBaoHanh::find($id);
        $phieubaohanh->TrangThai=3;
        $phieubaohanh->save();
        //save phieu trung tam
        if ($phieubaohanh) {
            $phieutrungtam = new PhieuTrungTam();
            $phieutrungtam->NgayGui      =$this->request->ngaygui;
            $phieutrungtam->NgayTra      =$this->request->ngaytra;
            $phieutrungtam->idPBH        =$id;
            $phieutrungtam->save();
            $data['message']='success';
            event(new NotiWarrantly($data));
        }

    }
    public function update_status($id){
        $phieubaohanh=PhieuBaoHanh::find($id);
        return view('admin.phieubaohanh.capnhap_trangthai',['phieubaohanh'=>$phieubaohanh]);
    }
    public function post_update_status($id){

        $phieubaohanh=PhieuBaoHanh::find($id);
        if ($phieubaohanh->TrangThai==5){
            return redirect('admin/phieubaohanh/danhsach')->with('ThongBao','Phiếu bảo hành đã hoàn thành');
        }elseif($phieubaohanh->TrangThai==2){
            return redirect('admin/phieubaohanh/danhsach')->with('ThongBao','Phiếu bảo hành đã được xử lý');
        }else{
            $trangthai=$this->request->trangthai;
            if ($trangthai==5){
                if ($phieubaohanh->phieutrungtam==null) {
                    foreach ($phieubaohanh->chitietphieu as $ctpbh) {
                        $idlk = $ctpbh->idGLK;
                        $soluong = $ctpbh->SoLuong;

                        $linhkien = GiaLinhKien::find($idlk);
                        $soluonglk = $linhkien->SoLuong;
                        if ($soluonglk >= $soluong) {
                            $linhkien->SoLuong = $soluonglk - $soluong;
                        } else {
                            return redirect('admin/phieubaohanh/danhsach')->with('ThongBao', 'Số lượng linh kiện không đủ');
                        }
                        $linhkien->save();
                    }
                }
            }
        }
        $phieubaohanh->TrangThai=$trangthai;
        $phieubaohanh->save();
        return redirect('admin/phieubaohanh/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function henlai(){
        $id=$this->request->id;
        $ghichu=$this->request->ghichu;
        $arr = explode ("/", $this->request->ngaytra);
        if (count($arr)==3) $ngaytra = $arr[2]."-".$arr[0]."-".$arr[1];
        else $ngaytra = date("Y-m-d");

        $phieubaohanh=PhieuBaoHanh::find($id);
        $phieubaohanh->NgayHenLai   =$ngaytra;
        $phieubaohanh->GhiChu       =$ghichu;
        $phieubaohanh->save();
    }
    public function show_list(){
        $phieubaohanh=PhieuBaoHanh::all();
        echo json_encode($phieubaohanh);
    }
}
