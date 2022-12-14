<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Slider;
use App\Exports\ExportBrand;
use App\Imports\ImportBrand;
use Excel;
use App\CatePost;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
session_start();


class BrandProduct extends Controller
{
    //
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

    public function add_brand_product()
    {
        $this -> AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product()
    {
        $this -> AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->paginate(4); //dung DB
        // $all_brand_product = Brand::orderBy('brand_id','DESC')->get(); //dung model
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request)
    {
        $this -> AuthLogin();

        // $data = $request->all();

        $data = $request -> validate(
        [
            'brand_name' => 'required|unique:tbl_brand|max:255',
        ],
        [
            'brand_name.required' => 'Cần thêm tên thương hiệu',
            'brand_name.unique' => 'Thương hiệu đã tồn tại',
        ]);

        // $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $request->brand_slug;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);

        // $brand = new Brand();
        // $brand->brand_name = $data['brand_name'];
        // $brand->brand_slug = $data['brand_slug'];
        // $brand->brand_desc = $data['brand_product_desc'];
        // $brand->brand_status = $data['brand_product_status'];
        // $brand->save();

        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id)
    {
        $this -> AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message', 'Ngừng kích hoạt thương hiệu sản phẩm');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this -> AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id)
    {
        $this -> AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this -> AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;

        // DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        $data = $request -> all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        // $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id)
    {
        $this -> AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

//End code admin

   public function show_brand_home(Request $request, $brand_slug){
        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();

        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        
        
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->paginate(3);

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }
         
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function export_csv_brand()
    {
        return Excel::download(new ExportBrand , 'brand.xlsx');
    }
    
    public function import_csv_brand(Request $request)
    {
        if ( $request->file('file')){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ImportBrand, $path);
        return back()->with('message','Thêm thương hiệu thành công');
    }

    else{
        return Redirect::back()->withErrors(['message' => 'Vui lòng không để trống file']);
    }
    }
}
