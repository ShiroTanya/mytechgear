<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Orhanerday\OpenAi\OpenAi;
use App;
use Session;
use App\Http\Requests;
use Mail;
use App\CatePost;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
use App\Product;
session_start();

class HomeController extends Controller
{

    public function error_page(){
        return view('errors.404');
    }



    public function index(Request $request){
        App::setlocale(session()->get('locate'));
        //category post
        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();

        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 
        $meta_desc = "Website phân phối các mặt hàng công nghệ uy tín nhất HUTECH"; 
        $meta_keywords = "Gaming, Máy chơi game, phụ kiện game";
        $meta_title = "TechGear | Website cung cấp các loại máy chơi game và hàng công nghệ top đầu Hutech";
        $url_canonical = $request->url();
        //--seo
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post); 
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }
    public function search(Request $request){
        $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);

    }

    public function autocomplete_search(Request $request)
    {
        $data = $request->all();

        if($data['query'])
        {
            $product = Product::where('product_status', 0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block; z-index: 2000; z-index-inverse: 2000;">';
            foreach($product as $key => $val)
            {
                $output .= '<li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    // public function ai_search(Request $request)
    // {
    //     $category_post = CatePost::orderby('cate_post_id', 'DESC')->get();
    //      //slide
    //     $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

    //     //seo 
    //     $meta_desc = "Tìm kiếm sản phẩm"; 
    //     $meta_keywords = "Tìm kiếm sản phẩm";
    //     $meta_title = "Tìm kiếm sản phẩm";
    //     $url_canonical = $request->url();
    //     //--seo
    //     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
    //     $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

    //     return view('pages.ai_searching')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);

    // }

    // public function result(Request $request)
    // {
    //     $topic = $request -> topic;

    //     $open_ai = new OpenAi(env('OPEN_AI_API_KEY'));
    //     $prompt = "Tìm nhanh 5 sản phẩm".$topic;

    //     $openAiOutput = $open_ai->complete([
    //        'engine' => 'davinci-instruct-beta-v3',
    //        'prompt' => $prompt,
    //        'temperature' => 0.9,
    //        'max_tokens' => 150,
    //        'frequency_penalty' => 0,
    //        'presence_penalty' => 0.6,
    //     ]);

    //     dd($openAiOutput);
    //     return Redirect::to('/ai')->with('message', 'test');


    //     $output = json_decode($openAiOutput, true);
    //     $outputText = $output["choices"][0]["text"]; 
    //     return Redirect::to('/ai')->with('message', $openAiOutput);
    // }
        

}