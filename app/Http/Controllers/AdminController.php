<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Social;
use App\SocialCustomer;
use Auth;
use App\Product;
use App\Post;
use App\Order;
use App\Customer;
use Socialite;
use App\Statistic;
use App\Login;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
// use Validator;
// use App\Rules\Captcha;
session_start();

class AdminController extends Controller
{

    public function login_google(){
        return Socialite::driver('google')->stateless()->redirect();
    }
    // public function callback_google(){
    //         $users = Socialite::driver('google')->stateless()->user(); 
    //         // return $users->id;
    //         // return $users->name;
    //         // return $users->email;
    //         $authUser = $this->findOrCreateUser($users,'google');
    //         $account_name = Login::where('admin_id',$authUser->user)->first();
    //         Session::put('admin_name',$account_name->admin_name);
    //         Session::put('admin_id',$account_name->admin_id);
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');  
    // }

    // public function findOrCreateUser($users, $provider){
    //         $authUser = Social::where('provider_user_id', $users->id)->first();
    //         if($authUser){

    //             return $authUser;
    //         }
          
    //         $customer_new = new Social([
    //             'provider_user_id' => $users->id,
    //             'provider_user_email' => $users->email,
    //             'provider' => strtoupper($provider)
    //         ]);

    //         $customer = Login::where('admin_email',$users->email)->first();

    //             if(!$customer){
    //                 $customer = Login::create([
    //                     'admin_name' => $users->name,
    //                     'admin_email' => $users->email,
    //                     'admin_password' => '',
    //                     'admin_phone' => '',
    //                     'admin_status' => 1
                        
    //                 ]);
    //             }

    //         $customer_new->login()->associate($customer);
                
    //         $customer_new->save();

    //         $account_name = Login::where('admin_id',$authUser->user)->first();
    //         Session::put('admin_login',$account_name->admin_name);
    //         Session::put('admin_id',$account_name->admin_id); 
          
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');


    // }


    // public function login_facebook(){
    //     return Socialite::driver('facebook')->stateless()->redirect();
    // }

    // public function callback_facebook(){
    //     $provider = Socialite::driver('facebook')->user();
    //     $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();


    //     if($account){
    //         //login in vao trang quan tri  
    //         $account_name = Login::where('admin_id',$account->user)->first();
    //         Session::put('admin_name',$account_name->admin_name);
    //         Session::put('login_normal',true);            
    //         Session::put('admin_id',$account_name->admin_id);
    //     }else{

    //         $admin_login = new Social([
    //             'provider_user_id' => $provider->getId(),
    //             'provider' => 'facebook'
    //         ]);

    //         $customer = Login::where('admin_email',$provider->getEmail())->first();

    //         if(!$customer){
    //             $customer = Login::create([
    //                 'admin_name' => $provider->getName(),
    //                 'admin_email' => $provider->getEmail(),
    //                 'admin_password' => '',
    //                 'admin_phone' => ''
                    
    //             ]);
    //         }
    //         $admin_login->login()->associate($customer);
    //         $admin_login->save();

    //         $account_name = Login::where('admin_id',$admin_login->user)->first();
    //         Session::put('admin_name',$admin_login->admin_name);
    //         Session::put('login_normal',true);            
    //         Session::put('admin_id',$admin_login->admin_id);
    //     } 
    //     return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');

    // }

    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }


    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();

        $product = Product::all()->count();
        $post = Post::all()->count();
        $order = Order::all()->count();
        $customer = Customer::all()->count();

        $product_views = Product::orderby('product_views','DESC')->take(15)->get();
        $post_views = Post::orderby('post_views','DESC')->take(15)->get();

        return view('admin.dashboard')->with(compact('product','post','order','customer','product_views','post_views'));
    }

    public function dashboard(Request $request)
    {
        $data = $request->all();
        // $data = $request->validate([
        //     //validation laravel 
        //     'admin_email' => 'required',
        //     'admin_password' => 'required',
        //    'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        // ]);


        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
                return Redirect::to('/admin');
        }
       

    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function register()
    {
        return view('admin_register');
    }

    public function add_admin(Request $request)
    {
        $data = array();
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;

        $admin_id = DB::table('tbl_admin')->insertGetId($data);

        Session::put('admin_id', $admin_id);
        Session::put('admin_name', $request->admin_name);
        Session::put('message','Đăng ký tài khoản thành công');
        return Redirect::to('/register');
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach($get as $key =>$val)
        {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        
        //Vi du ve CARBON
        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay')
        {
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderby('order_date', 'ASC')-> get();
        }
        elseif($data['dashboard_value'] == 'thangtruoc')
        {
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderby('order_date', 'ASC')-> get();
        }
        elseif($data['dashboard_value'] == 'thangnay')
        {
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderby('order_date', 'ASC')-> get();
        }
        else
        {
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderby('order_date', 'ASC')-> get();
        }

       foreach($get as $key =>$val)
        {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity            
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function days_order(Request $request)
    {
        
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();     
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderby('order_date', 'ASC')->get();

       foreach($get as $key =>$val)
        {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity            
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function login_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->stateless()->redirect();
    }

     public function callback_customer_google(){
            config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
            $users = Socialite::driver('google')->stateless()->user(); 
            $authUser = $this->findOrCreateCustomer($users,'google');

            if($authUser)
            {
            $account_name = Customer::where('customer_id',$authUser->user)->first();
                Session::put('customer_id',$account_name->customer_id);
                Session::put('customer_picture',$account_name->customer_picture);
                Session::put('customer_name',$account_name->customer_name);
            }elseif($customer_new)
            {
                $account_name = Customer::where('customer_id',$authUser->user)->first();
                Session::put('customer_id',$account_name->customer_id);
                Session::put('customer_picture',$account_name->customer_picture);
                Session::put('customer_name',$account_name->customer_name);
            }
            
           
            return redirect('/checkout')->with('message', 'Đăng nhập bằng tài khoản google: <span style="color: red">'.$account_name->customer_email.'</span> thành công');  
    }

    public function findOrCreateCustomer($users, $provider){

         $authUser = SocialCustomer::where('provider_user_id', $users->id)->first();
            if($authUser){

                return $authUser;
            }else{
                 $customer_new = new SocialCustomer([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);
            $customer = Customer::where('customer_email',$users->email)->first();
            
                if(!$customer){
                    $customer = Customer::create([
                        'customer_name' => $users->name,
                        'customer_email' => $users->email,
                        'customer_password' => '',
                        'customer_phone' => ''                  
                    ]);
                }
            }

            $customer_new->Customer()->associate($customer);
                
            $customer_new->save();
            return $customer_new;
    }


     public function login_facebook_customer(){
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callback_facebook_customer(){
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        $provider = Socialite::driver('facebook')->stateless()->user(); 

            $account = SocialCustomer::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
            if($account != NULL )
            {
                $account_name = Customer::where('customer_id',$account->user)->first();
                Session::put('customer_id',$account_name->customer_id);
                Session::put('customer_name',$account_name->customer_name);

                 return redirect('/checkout')->with('message', 'Đăng nhập bằng tài khoản facebook thành công');  

            }
            elseif($account == NULL)
            {
                $customer_login = new SocialCustomer([
                    'provider_user_id' => $provider->getId(),
                    'provider_user_email' => $provider->getEmail(),
                    'provider' => 'facebook'
                ]);
            

            $customer = Customer::where('customer_email', $provider->getEmail())->first();

            if(!$customer)
            {
                $customer = Customer::create([
                    'customer_name' => $provider->getId(),
                    'customer_email' => $provider->getEmail(),
                    'customer_picture' => '',
                    'customer_password' => '',
                    'customer_phone' => ''

                ]);
            }
        }
            $customer_login->customer()->associate($customer);
            $customer_login->save();
           
            $account_new = Customer::where('customer_id',$customer_login->user)->first();
                Session::put('customer_id',$account_new->customer_id);
                Session::put('customer_name',$account_new->customer_name);

                 return redirect('/checkout')->with('message', 'Đăng nhập bằng tài khoản facebook thành công');  
    }

}
