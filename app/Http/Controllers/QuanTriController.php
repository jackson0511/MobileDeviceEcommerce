<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuanTri;
use App\Quyen;
use Illuminate\Support\Facades\Auth;
use Mail;
class QuanTriController extends Controller
{
    //
    public function getList(){
        $quantri=QuanTri::where('id','!=', Auth::guard('QuanTri')->user()->id)->get();
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
        $quantri->active=$this->request->trangthai;
//        if($this->request->password && $this->request->passwordagain){
//            $this->validate($this->request,
//                [
//                'password'      =>'required',
//                'passwordagain' =>'required|same:password',
//                ],
//                [
//                'password.required'  =>'Bạn chưa nhập mật khẩu',
//                'passwordagain.required'  =>'Bạn chưa nhập lại mật khẩu',
//                'passwordagain.same'  =>'Mật khẩu không giống nhau',
//                ]);
//            $quantri->password=bcrypt($this->request->password);
//        }
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
    public function resetPass($id){
        $quantri=QuanTri::find($id);
        $email=$quantri->Email;
        $code=str_random(4);
        $data=[
            'name'      =>$quantri->HoTen,
            'code'      =>$code,
        ];
        //gui mail
        Mail::send('frontend.email-template.reset_pass',$data, function($message) use ($email){
            $message->from('it.duonggiabao@gmail.com','Quản Trị Viên');
            $message->to($email, 'Reset Mật Khẩu');
            $message->subject('Reset Mật Khẩu!');
        });
        $quantri->password=bcrypt($code);
        $quantri->save();
        return redirect('admin/quantri/danhsach')->with('ThongBao','Reset thành công');
    }
    public function getKhoa($id){
        $quantri=QuanTri::find($id);
        if($quantri->active==0){
            return redirect('admin/quantri/danhsach')->with('ThongBao','Tài khoản chưa được kích hoạt ');
        }else{
            $active=0;
            $quantri->active=$active;
            $quantri->save();
            return redirect('admin/quantri/danhsach')->with('ThongBao','Khoá thành công');
        }
    }
}
