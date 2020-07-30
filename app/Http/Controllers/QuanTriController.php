<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuanTri;
use App\Quyen;
class QuanTriController extends Controller
{
    //
    public function getList(){
        $quantri=QuanTri::all();
        return view('admin.quantri.danhsach',['quantri'=>$quantri]);
    }
    public function getAdd(){
        $quyen=Quyen::all();
        return view('admin.quantri.them',['quyen'=>$quyen]);
    }
    public function postAdd(){
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'email'		    =>'required|unique:QuanTri,Email',
                'password'      =>'required',
                'passwordagain' =>'required|same:password',
                'sdt'           =>'required',
                'quyen'         =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'email.required'  =>'Bạn chưa nhập email',
                'email.unique'  => 'Email đã tồn tại',
                'password.required'  =>'Bạn chưa nhập mật khẩu',
                'passwordagain.required'  =>'Bạn chưa nhập lại mật khẩu',
                'passwordagain.same'  =>'Mật khẩu không giống nhau',
                'sdt.required'  =>'Bạn chưa nhập số điện thoại',
                'quyen.required'  =>'Bạn chưa nhập quyền',
            ]);
        $quantri=new QuanTri();
        $quantri->HoTen=$this->request->ten;
        $quantri->Email=$this->request->email;
        $quantri->SoDienThoai=$this->request->sdt;
        $quantri->password=bcrypt($this->request->password);
        $quantri->save();
        if($quantri) {
            $quyen = $this->request->quyen;
            foreach ($quyen as $id) {
                $quantri->quyen()->attach($id);
            }
        }
        return redirect('admin/quantri/danhsach')->with('ThongBao','Thêm thành công');
    }
    public function getEdit($id){
        $quantri=QuanTri::find($id);
        $quyen=Quyen::all();
        return view('admin.quantri.sua',['quyen'=>$quyen,'quantri'=>$quantri]);
    }
    public function postEdit($id){
        $quantri=QuanTri::find($id);
        $this->validate($this->request,
            [
                'ten'           =>'required',
                'sdt'           =>'required',
                'quyen'         =>'required',
            ],
            [
                'ten.required'  =>'Bạn chưa nhập tên',
                'sdt.required'  =>'Bạn chưa nhập số điện thoại',
                'quyen.required'  =>'Bạn chưa nhập quyền',
            ]);
        $quantri->HoTen=$this->request->ten;
        $quantri->SoDienThoai=$this->request->sdt;
        if($this->request->password && $this->request->passwordagain){
            $this->validate($this->request,
                [
                'password'      =>'required',
                'passwordagain' =>'required|same:password',
                ],
                [
                'password.required'  =>'Bạn chưa nhập mật khẩu',
                'passwordagain.required'  =>'Bạn chưa nhập lại mật khẩu',
                'passwordagain.same'  =>'Mật khẩu không giống nhau',
                ]);
            $quantri->password=bcrypt($this->request->password);
        }
        $quantri->save();
        if($quantri) {
            $quyen = $this->request->quyen;
            $quantri->quyen()->detach();
            foreach ($quyen as $id) {
                $quantri->quyen()->attach($id);
            }
        }
        return redirect('admin/quantri/danhsach')->with('ThongBao','Cập nhập thành công');
    }
}
