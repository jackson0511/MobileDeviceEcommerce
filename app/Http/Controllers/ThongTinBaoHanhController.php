<?php

namespace App\Http\Controllers;

use App\SanPham;
use App\ThongTinBaoHanh;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThongTinBaoHanhController extends Controller
{
    public function getList(){
        $thongtinbaohanh=ThongTinBaoHanh::all();
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        foreach ($thongtinbaohanh as $ttbh){
            $ngayapdung=$ttbh->NgayApDung;
            $ngayketthuc=$ttbh->NgayKetThuc;
            if($ngay>$ngayketthuc){
                $ttbh->TrangThai=1;
                $ttbh->save();
            }
            if ($ngay>=$ngayapdung && $ngay<=$ngayketthuc){
                $ttbh->TrangThai=0;
                $ttbh->save();
            }
        }
        return view('admin.thongtinbaohanh.danhsach',['thongtinbaohanh'=>$thongtinbaohanh]);
    }
    public function search(){
        $keyword=$this->request->keyword;
        $thongtinbaohanh=ThongTinBaoHanh::where('IMEI',$keyword)->get();
        return view('admin.thongtinbaohanh.danhsach',['thongtinbaohanh'=>$thongtinbaohanh]);
    }
    public function getListOption(){
        $id=$this->request->id;
        $thongtinbaohanh=ThongTinBaoHanh::find($id);
        $idsp=$thongtinbaohanh->idSP;
        $sanpham=SanPham::find($idsp);
        $options=$sanpham->baohanh->optionbaohanh;
        echo   "<thead>
                   <tr align='center'>
                   <th>ID</th>
                   <th>Tên</th>
                   <th>Bảo hành</th>
                   </tr>
                 </thead>";
        foreach ($options as $option) {
            echo  "<tr align='center'>
                       <th>".$option->id."</th>
                       <th>".$option->Ten."</th>
                       <th>".$sanpham->baohanh->Ten."</th>
                   </tr>";
        }
    }
}
