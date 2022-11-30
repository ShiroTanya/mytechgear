<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use App\Http\Requests;
use App\Exports\ExportProduct;
use App\Imports\ImportProduct;
use Session;
use App\CatePost;
use App\Post;
use Auth;

use Illuminate\Support\Facades\Redirect;
session_start();
class PostController extends Controller
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

    public function add_post()
    {
        $this -> AuthLogin();
        $cate_post = CatePost::orderby('cate_post_id','DESC')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));

    }

   public function save_post(Request $request)
    {
        $this -> AuthLogin();

             $data = $request -> validate(
        [
            'post_desc' => 'required|max:255',
            'post_content' => 'required|max:255',
            'post_image' => 'required|image|mimes:jpeg,jpg,png,svg',
            // 'price_cost' => 'required|numeric|min:1|max:20',
        ],
        [
            'post_desc.required' => 'Bạn chưa điền tóm tắt bài viết',
            'post_content.required' => 'Bạn chưa điền nội dung bài viết',
            'post_image.required' => 'Cần hình ảnh sản phẩm',
            'post_image.image' => 'Cần hình ảnh sản phẩm',
            'post_image.mimes' => 'Bạn cần chọn đúng file (png,jpg,jpeg,...)'
            // 'price_cost.required' => 'Cần thêm giá gốc',
        ]);




        $data = $request->all();        
        $post = new Post();  //model se tao ra mot du lieu moi
        $post->post_title = $data['post_title']; //du lieu duoc gui tu add_post.blade.php
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
 		$post->post_status = $data['post_status'];

 		$get_image = $request -> file('post_image');

        if($get_image) 
        {   
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image -> move('public/uploads/post',$new_image);

            $post->post_image = $new_image;


            // DB::table('tbl_product')->insert($data);
            $post->save();

            Session::put('message','Thêm bài viết thành công');
            return redirect()->back();
        }else{
        	Session::put('message','Bạn cần thêm hình ảnh trước khi lưu');
            return redirect()->back();
        }
      

    }

    public function all_post()
    {
        $this -> AuthLogin();
        $all_post = Post::with('cate_post')->orderby('post_id')->paginate(5);
        return view('admin.post.list_post')->with(compact('all_post',$all_post));
    }

 
    public function delete_post($post_id)
    {
        $this -> AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        if($post_image)
        {   
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }

        $post -> delete();
        Session::put('message', 'Xóa bài viết thành công');
        return redirect()->back();
    }

    public function edit_post($post_id)
    {
        $cate_post = CatePost::orderby('cate_post_id','DESC')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }

    public function update_post(Request $request, $post_id)
    {
        $this -> AuthLogin();
        $data = $request->all();        
        $post = Post::find($post_id);


        $post->post_title = $data['post_title']; //du lieu duoc gui tu add_post.blade.php
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request -> file('post_image');

        if($get_image) 
        {   
            //Xoa anh cu
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);

            //Cap nhat anh moi (neu co)
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));

            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image -> move('public/uploads/post',$new_image);

            $post->post_image = $new_image;


            // DB::table('tbl_product')->insert($data);
           
        }
        $post->save();

        Session::put('message','Cập nhật bài viết thành công');
        return redirect::to('all-post');
    }

    public function danh_muc_bai_viet(Request $request, $post_slug){

        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();

        foreach($catepost as $key => $cate){

        //seo 
        $meta_desc = $cate->cate_post_desc;
        $meta_keywords = $cate->cate_post_slug;
        $meta_title = $cate->cate_post_name;
        $cate_id = $cate->cate_post_id;
        $url_canonical = $request->url();
    }



        $posts = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id',$cate_id)->paginate(3);

        return view('pages.baiviet.danhmucbaiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('posts',$posts)->with('category_post',$category_post);
    }

    public function bai_viet(Request $request, $post_slug)
    {
         $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();
        $posts = Post::with('cate_post')->where('post_status', 0)->where('post_slug',$post_slug)->take(1)->get();

        foreach($posts as $key => $p){

        //seo 
        $meta_desc = $p->post_meta_desc;
        $meta_keywords = $p->post_meta_keywords;
        $meta_title = $p->post_title;
        $cate_id = $p->cate_post_id;
        $url_canonical = $request->url();
        $cate_post_id = $p->cate_post_id;
        $post_id = $p->post_id;
    }

    $post = Post::where('post_id',$post_id)->first();
    $post->post_views = $post ->post_views + 1;
    $post->save();

    $related = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_post_id)->whereNotIn('post_slug',[$post_slug])->take(3)->get();
        

       

        return view('pages.baiviet.baiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('posts',$posts)->with('related', $related )->with('category_post',$category_post);
    }
}
