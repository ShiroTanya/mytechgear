<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Auth;


class AuthController extends Controller
{
    public function register_auth()
    {
    	return view('admin.custom_auth.register');
    }

    public function login_auth(){
    	return view('admin.custom_auth.login_auth');

    }

     public function logout_auth(){
    	Auth::logout();
    	return redirect('/login-auth')->with('message', 'Đăng xuất thành công');

    }

    public function login(Request $request)
    {
    	$this -> validate($request,[
			'admin_email' => 'required|max:255',
            'admin_password' => 'required|max:255',
        ],
        [
            'admin_email.required' => 'Vui lòng nhập email',
            // 'admin_email.min' => 'Email cần tối thiểu 8 ký tự',
            // 'admin_password.min' => 'Mật khẩu cần tối thiểu 8 ký tự',
            'admin_password.required' => 'Vui lòng nhập mật khẩu',
        ]);
//    	   $data = $request->all();

    	  	if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
    	  		return redirect('/dashboard');
    	  	}else{
    	  		return redirect('/login-auth')->with('message', 'Lỗi đăng nhập (sai tên tài khoản hoặc mật khẩu)');
    	  	}

    }



    public function registera(Request $request)
    {
    	$this->validation($request);
    	$data = $request->all();

    	$admin = new Admin();
    	$admin ->admin_name = $data['admin_name'];
    	$admin ->admin_phone = $data['admin_phone'];
    	$admin ->admin_email = $data['admin_email'];
    	$admin ->admin_password = md5($data['admin_password']);
    	$admin -> save();
    	return redirect('/register-auth')->with('message','Đăng ký thành công');
    }

    public function validation($request)
    {
    	return $this->validate($request,[
    		'admin_name' => 'required|max:255',
    		'admin_phone' => 'required|numeric',
    		'admin_email' => 'required|email|unique:tbl_admin|max:255',
    		'admin_password' => 'required|min:8|max:255',
        ],
        [
            'admin_name.required' => 'Bạn cần điền họ tên',
            'admin_phone.required' => 'Bạn cần điền số điện thoại',
            'admin_phone.numeric' => 'Bạn cần điền điền số điện thoại phù hợp',

            'admin_email.required' => 'Bạn cần điền email',
            'admin_email.email' => 'Bạn cần điền đúng định dạng (nên có chữ @)',
            'admin_email.unique' => 'Email đã tồn tại',

            'admin_password.required' => 'Bạn cần điền mật khẩu',
            'admin_password.min' => 'Mật khẩu tối thiểu 8 ký tự',
    	]);
    }


}
