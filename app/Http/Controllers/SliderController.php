<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
class SliderController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }
        else
        {
            return Redirect::to('login-auth')->send();
        }
    }
    public function manage_slider(){
        $all_slide = Slider::orderBy('slider_id','DESC')->paginate(2);
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){
        return view('admin.slider.add_slider');
    }
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('message','Không kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }
    public function active_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('message','Kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }

    public function insert_slider(Request $request){
        
        $this->AuthLogin();

        $data = $request -> validate(
        [
            'slider_image' => 'required|image|mimes:jpeg,jpg,png,svg',
        ],
        [
            'slider_image.required' => 'Cần hình ảnh banner',
            'slider_image.image' => 'Cần hình ảnh banner',
            'slider_image.mimes' => 'Bạn cần chọn đúng file (png,jpg,jpeg,...)'
        ]);

        $data = $request->all();
        $get_image = request('slider_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            Session::put('message','Thêm slider thành công');
            return Redirect::to('manage-slider');
        }else{
            Session::put('message','Làm ơn thêm hình ảnh');
            return Redirect::to('add-slider');
        }
        
    }

    public function delete_slider($slide_id)
    {
        $slider = Slider::find($slide_id);
        $slider_del = $slider->slider_image;
        if($slider_del)
        {   
            $path = 'public/uploads/slider/'.$slider_del;
            unlink($path);
        }

        $slider -> delete();
        Session::put('message', 'Xóa Slider thành công');
        return Redirect::to('manage-slider');
    }
}
