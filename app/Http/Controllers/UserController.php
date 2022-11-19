<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Roles;
use App\Admin;
use Session;
use Auth;

class UserController extends Controller
{
    
    public function index()
    {
        
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }

    public function impersonate($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','Lỗi!!! Bạn không thể chọn tài khoản hiện tại để sử dụng chức năng này!');
        }

        $user = Admin::where('admin_id', $admin_id)->first();
        if($user){
            session()->put('impersonate',$user->admin_id);
        }
        return redirect('/dashboard')->with('message','Chuyển đổi tài khoản thành công');
    }

    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/dashboard')->with('message','Đã trở về tài khoản mặc định');
    }

    public function add_users(){
        return view('admin.users.add_users');
    }

    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            return redirect()->back()->with('message','Lỗi!!! Bạn không thể xóa tài khoản hiện đang sử dụng!');
        }

        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','Xóa tài khoản thành công!');
    }

    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id){
            return redirect()->back()->with('message','Lỗi!!! Bạn không thể chỉnh sửa quyền hạn của tài khoản đang sử dụng!');
        }
        $user = Admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }

    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        
        $admin->roles()->attach(Roles::where('name','user')->first());
        $admin->save();
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





}
