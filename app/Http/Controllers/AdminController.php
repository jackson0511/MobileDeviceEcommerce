<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data=$this->request->only(['email','password']);
    }
}
