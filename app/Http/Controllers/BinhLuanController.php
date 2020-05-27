<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BinhLuan;
class BinhLuanController extends Controller
{
    public function getList(){
        $binhluan=BinhLuan::orderByRaw('id DESC')->get();
        return view('admin/binhluan/danhsach',['binhluan'=>$binhluan]);
    }
    public function getXuly($id){
        $binhluan=BinhLuan::find($id);

        if($binhluan->TrangThai==1){
            return redirect('admin/binhluan/danhsach')->with('ThongBao','Bình luận đã được trả lời');
        }else{
            $trangthai=1;
        }
        $binhluan->TrangThai=$trangthai;
        $binhluan->save();

        return redirect('admin/binhluan/danhsach')->with('ThongBao','Xử lý trả lời bình luận thành công');
    }

}
