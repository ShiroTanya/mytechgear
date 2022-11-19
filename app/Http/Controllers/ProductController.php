<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use App\Http\Requests;
use App\Exports\ExportProduct;
use App\Imports\ImportProduct;
use App\Comment;
use Excel;
use App\Product;
use App\Rating;
use Session;
use App\CatePost;
use Auth;

use Illuminate\Support\Facades\Redirect;
session_start();


class ProductController extends Controller
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
            return Redirect::to('admin')->send();
        }
    }


    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0 ;
        $comment->comment_name = 'Admin' ;
        $comment ->save();
        
    }

     public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment -> comment_status = $data['comment_status'];
        $comment ->save();
        
    }

    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderby('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }


    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment -> save();


    }



    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= ' 
             <div class="row style_comment">

                    <div class="col-md-2">
                                                   
                                            <img width="100%" src="'.url('/public/frontend/images/User123.png').'" 
                                            class= "img img-responsive img-thumbnail">
                                                </div>
                                                <div class="col-md-10">
                                                    <p style="color: green;">@'.$comm->comment_name.'</p>
                                                    <p style="color: #000;">'.$comm->comment_date.'</p>
                                                    <p>'.$comm->comment.' </p>
                                                </div>

                                            </div><p></p>
                                            ';

                                            foreach ($comment_rep as $key => $rep_comment) {
                                                if($rep_comment->comment_parent_comment==$comm->comment_id){
                                            

                                            $output.= '  <div class="row style_comment" style="margin : 5px 40px;background:#00ffbf">

                    <div class="col-md-2">
                                                   
                                            <img width="80%" src="'.url('/public/frontend/images/adminweb.jpg').'" 
                                            class= "img img-responsive img-thumbnail">
                                                </div>
                                                <div class="col-md-10">
                                                    <p style="color: blue;">@Admin</p>
                                                    <p style="color: #000;">'.$rep_comment->comment.'</p>
                                                    <p> </p>
                                                </div>
                                            </div><p></p>';

                                        }
                                    }


             
        }
        echo $output;

    }


    public function add_product()
    {
        $this -> AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);

    }

    public function all_product()
    {
        $this -> AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id')->paginate(5);
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this -> AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_tags'] = $request->product_tags;
        // $data['product_sold'] = $request->product_sold;        
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['price_cost'] = $request->price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;

        $get_image = $request->file('product_image');

        if($get_image)
        {   
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;

            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
        }else
        {
            Session::put('message','Bạn cần thêm hình ảnh trước khi lưu');
            return redirect()->back();
        }
    }

    public function unactive_product($product_id)
    {
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message', 'Ngừng kích hoạt sản phẩm');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this -> AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this -> AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request,$product_id)
    {
        $this -> AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['price_cost'] = $request->price_cost;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image)
        {   
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);        
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }


    public function delete_product($product_id)
    {
        $this -> AuthLogin();
        $product = Product::find($product_id);
        $product_image = $product ->product_image;

        if($product_image)
        {
            $path = 'public/uploads/product/'.$product_image;
            unlink($path);
        }

        $product -> delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //End code admin

    public function details_product($product_slug, Request $request)
    {
        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

         $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_cate = $value->category_name;
            $cate_slug = $value->slug_category_product;
            //SEO
             $meta_desc = $value->product_desc;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
            //SEO
        }

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
               

         $product = Product::where('product_id',$product_id)->first();
         $product->product_views = $product ->product_views + 1;
         $product->save();

    // Lay ra tat ca san pham thuoc cung category id

         $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_slug',[$product_slug])->paginate(3);


        // return view('pages.sanpham.show_details')->with(compact('cate_product','brand_product','details_product','related_product','meta_desc','meta_keywords','meta_title','url_canonical','slider','category_post'));
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('product_cate',$product_cate)->with('cate_slug',$cate_slug)->with('rating',$rating);
    }


    public function export_csv_product()
    {
        return Excel::download(new ExportProduct , 'product.xlsx');
    }
    
    // public function import_csv_product(Request $request)
    // {
    //     $path = $request->file('file')->getRealPath();
    //     Excel::import(new ImportProduct, $path);
    //     return back();
    // }

      public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo'done';
    }

     public function import_csv_product(Request $request)
    {
                if ( $request->file('file')){
                $path = $request->file('file')->getRealPath();
                Excel::import(new ImportProduct, $path);
                return back()->with('message','Thêm sản phẩm thành công');
            }

            else{
                return Redirect::back()->withErrors(['message' => 'Vui lòng không để trống file']);
            }
    }

    public function tag(Request $request, $product_tag){
        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $tag = str_replace("-"," ",$product_tag);
        $pro_tag = Product::where('product_status',0)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orWhere('product_slug','LIKE','%'.$tag.'%')->get();

        
             $meta_desc = 'Tags:'.$product_tag;
                $meta_keywords = 'Tags :'.$product_tag;
                $meta_title = 'Tags:'.$product_tag;
                $url_canonical = $request->url();
        
       
     
        return view('pages.sanpham.tag')->with('slider',$slider)->with('category_post',$category_post)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }

}
