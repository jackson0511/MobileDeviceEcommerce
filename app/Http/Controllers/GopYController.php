<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GopY;
class GopYController extends Controller
{
    public function getList(){
        $gopy=GopY::orderByRaw('id DESC')->get();
        return view('admin.gopy.danhsach',['gopy'=>$gopy]);
    }
    public function getXuly($id){
        $gopy=GopY::find($id);

        if($gopy->TrangThai==1){
            return redirect('admin/gopy/danhsach')->with('ThongBao','góp ý đã được đọc');
        }else{
            $trangthai=1;
        }
        $gopy->TrangThai=$trangthai;
        $gopy->save();

        return redirect('admin/gopy/danhsach')->with('ThongBao','Xử lý đọc góp ý thành công');
    }
}
