<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BinhLuan;
use Illuminate\Support\Facades\Auth;

class BinhLuanController extends Controller
{
    public function getList(){
        $binhluan=BinhLuan::orderByRaw('id DESC')->get();
        return view('admin/binhluan/danhsach',['binhluan'=>$binhluan]);
    }
    public function getTraloi($id){
        $binhluan=BinhLuan::find($id);
        return view('admin/binhluan/traloi',['binhluan'=>$binhluan]);
    }
    public function postTraloi($id){
        $this->validate($this->request,
            [
                'traloi'            =>'required',
            ],
            [
                'traloi.required'   =>'Bạn chưa nhập nội dung',
            ]);
        $binhluan=new BinhLuan();
        $idqt=Auth::guard('QuanTri')->id();
        $binhluan->NoiDung= $this->request->traloi;
        $binhluan->TrangThai=1;
        $binhluan->TrangThai_Admin=1;
        $binhluan->parent_id=$id;
        $binhluan->idKH=$this->request->idkh;
        $binhluan->idSP=$this->request->idsp;
        $binhluan->idQT=$idqt;
        $binhluan->save();

        $binhluan1=BinhLuan::find($id);
        $binhluan1->TrangThai=1;
        $binhluan1->save();
        return redirect('admin/binhluan/danhsach')->with('ThongBao','Trả lời bình luận thành công');
    }

}
