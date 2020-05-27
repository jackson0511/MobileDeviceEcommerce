<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\QuanTri;
class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
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
