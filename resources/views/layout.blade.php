<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------Seo--------->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />

    {{--   <meta property="og:image" content="{{$image_og}}" />  
      <meta property="og:site_name" content="http://localhost/shopLPD" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}

    <!--//-------Seo--------->
    <title>{{$meta_title}}</title>

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="imageages/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top" style="background: #fff"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 961 247 427</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> TechGear@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('login-customer-facebook')}}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="{{url('login-customer-google')}}"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/')}}"><img src="{{('public/frontend/images/LogoTG.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    Ng??n ng???
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('lang/en')}}">English</a></li>
                                    <li><a href="{{url('lang/vi')}}">Ti???ng Vi???t</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VN??
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dollar</a></li>
                                    <li><a href="#">VND</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                                <li><a href="#"><i class="fa fa-star"></i> Y??u th??ch</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                 }
                                ?>
                                

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>

                               
                                @php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 @endphp
                                  <li><a href="{{URL::to('history')}}"><i class="fa fa-bell"></i> L???ch s??? ????n h??ng</a></li>
                                
                                @php
                                     }
                                @endphp


                                 <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> ????ng xu???t</a></li>
                                
                                <?php
                            }else{
                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> ????ng nh???p</a></li>
                                 <?php 
                                }
                                 ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom" id="navbarsticky" style="background: #F3F6FA"><!--header-bottom-->
            <div class="container" >
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">@lang('lang.home')</a></li>
                                <li class="dropdown"><a href="#">@lang('lang.product')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                       @foreach($category as $key => $danhmuc)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 

                                <li class="dropdown"><a href="#">@lang('lang.blogs')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                       @foreach($category_post as $key => $danhmucbaiviet)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                        @endforeach<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" async defer></script>
                                    </ul>
                                </li> 


                                <li><a href="{{URL::to('/gio-hang')}}">@lang('lang.cart')</a></li>
                                <li><a href="{{URL::to('/lien-he')}}">@lang('lang.contact')</a></li>

                                    {{-- <form action="{{URL::to('/result')}}" autocomplete="off" method="POST">
                                        @csrf
                                        <input type="text" style="width: 60%;border: 100px;" name="topic" placeholder="T??m ki???m nhanh"/>
                                        <button type="submit" class="btn-sm btn-danger"> T??m </button>
                                    </form> --}}

                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">

                            {{csrf_field()}}
                        <div class="search_box">

                            <input type="text" style="width: 60%;border: 100px;" name="keywords_submit" id="keywords" placeholder="T??m ki???m s???n ph???m"/>

                            <span id="search_ajax"></span>

                            <input type="submit" style="margin-top:0px; color:#666" name="search_items" class="btn btn-primary btn-sm" value="T??m ki???m" >
                        </div>
                        </form>
                    </div>

                    <div style="clear: both;"></div>

                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="margin-top: 25px">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                        @php 
                            $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                            @php 
                                $i++;
                            @endphp
                            <div class="item {{$i==1 ? 'active' : '' }}">
                                <div class="col-sm-4">
                                    <h1><span>Tech</span>-Gear</h1>
                                    <h2>Website ph??n ph???i c??c m???t h??ng c??ng ngh??? uy t??n nh???t HUTECH</h2>                                                                 
                                </div>                      
                                <div class="col-sm-7">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="100" width="100%" class="img img-responsive">
                                   
                                </div>
                            </div>
                        @endforeach  
                          
                            
                        </div>                    
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container" >
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh m???c s???n ph???m</h2>
                        <div class="category-products" id="accordian"><!--category-productsr-->

                            @foreach($category as $key => $cate)
                            <div class="panel panel-default">
                                @if($cate->category_parent==0)
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                            <span class="badge pull-right"><i class="fa fa-plus">{{-- <a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}"> --}}</i></span>{{$cate->category_name}}</a>
                                    </h4>
                                    
                                </div>

                                <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($category as $key => $cate_sub)
                                                @if($cate_sub->category_parent==$cate->category_id)

                                                    <li>
                                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}} </a>
                                                    </li>  
                                                                                              
                                                @endif
                                            @endforeach

                                        </ul>   
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                    
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Th????ng hi???u</h2>

                            
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">

                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_slug)}}"><span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>

                            </div>
                            
                        </div><!--/brands_products-->
                        
                        <div class="brands_products"><!--brands_products-->
                            <h2>S???n ph???m y??u th??ch</h2>        
                            <div class="brands-name">
                                <div id="row_wishlist" class="row">
                                    
                                </div>

                                <div id="delete_wishlist" class="row">
                                </div>


                            </div>
                            
                        </div>
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>

            {{-- <style type="text/css">
                h3.doitac {
                    text-align: center;
                    font-size: 20px;
                    text-transform: uppercase;
                    margin: 20px;
                    font-weight: bold;
                }
                h4.doitac_name{
                    text-align: center;
                    font-size: 13px;
                }
                /*.item img{
                    height: 100px
                }*/
               /* button.owl-prev{
                    font-size: 45px !important;
                }
                button.owl-next{
                    font-size: 45px !important;
                }*/
            </style>
                <div class="col-md-12" >
                    <h3 class="doitac"> ?????i t??c c???a ch??ng t??i </h3>
                    <div class="owl-carousel owl-theme">
                        <div class="item" style="padding-left:0 !important">
                            <a target="_blank" href="https://phongvu.vn/">
                                <p><img height="100px" width="100%" src="{{'public/frontend/images/PhongvuLogo.png'}}"></p>
                                <h4 class="doitac_name"> Phong V??</h4>
                            </a>
                        </div>
                        <div class="item" style="padding-left:0 !important">
                            <a target="_blank" href="https://xgear.net/">
                                <p><img height="100px" width="100%" src="{{'public/frontend/images/XgearLogo.png'}}"></p>
                                <h4 class="doitac_name"> Xgear</h4>
                            </a>
                        </div>
                        <div class="item" style="padding-left:0 !important">
                            <a target="_blank" href="https://gearvn.com/">
                                <p><img height="100px" width="100%" src="{{'public/frontend/images/GearvnLogo.png'}}"></p>
                                <h4 class="doitac_name"> Gear VN</h4>
                            </a>
                        </div>
                        <div class="item" style="padding-left:0 !important">
                            <a target="_blank" href="https://tinhocngoisao.com/">
                                <p><img height="100px" width="100%" src="{{'public/frontend/images/THNSLogo.png'}}"></p>
                                <h4 class="doitac_name"> Tin h???c ng??i sao</h4>
                            </a>
                        </div>
                        <div class="item" style="padding-left:0 !important">
                            <a target="_blank" href="https://www.asus.com/vn/">
                                <p><img height="100px" width="100%" src="{{'public/frontend/images/AsusLogo.png'}}"></p>
                                <h4 class="doitac_name"> Asus</h4>
                            </a>
                        </div>
                    </div>         
                </div> --}}
            </div>
        </div>
    </section>

    
    <footer id="footer" style="background: #F3F6FA; margin-top: 20px"><!--Footer-->
        <div class="footer-top">
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>D???ch v???</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ???s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Th????ng hi???u</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/edra')}}">Edra</a></li>
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/asus')}}">Asus</a></li>
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/sony')}}">Sony</a></li>
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/samsung')}}">Samsung</a></li>
                                <li><a href="{{URL::to('/thuong-hieu-san-pham/dell')}}">Dell</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Ch??nh s??ch</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>B???n tin</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{URL::to('/danh-muc-bai-viet/tin-giai-tri')}}">Tin gi???i tr??</a></li>
                                <li><a href="{{URL::to('/danh-muc-bai-viet/tin-the-thao')}}">Tin th??? thao</a></li>
                                <li><a href="{{URL::to('/danh-muc-bai-viet/tin-thoi-su')}}">Tin th???i s???</a></li>
                                <li><a href="{{URL::to('/danh-muc-bai-viet/tin-cong-nghe')}}">Tin c??ng ngh???</a></li>
                                <li><a href="{{URL::to('/danh-muc-bai-viet/tin-quoc-te')}}">Tin qu???c t???</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Ph???n h???i</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Ph???n h???i kh??ch h??ng" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <div class="address">
                        <img src="{{('public/frontend/images/map.png')}}" alt="" /> 
                            <p>HUTECH - Khu c??ng ngh??? cao - Q.9, TP.HCM, Vi???t Nam</p>
                        </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom" style="background: #F3F6FA">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright ?? 2022 TechGear Inc. ???? ????ng k?? b???n quy???n.</p>
                    {{-- <p class="pull-right"><span> <img src="{{asset('public/uploads/slider/payment-item.png')}}" alt=""></span></p> --}}
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="8l4pK4n0"></script>
<script type="text/javascript">
        
        $.validate({

        }); 

</script>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>

<script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "X??c nh???n ????n h??ng",
                  text: "????n h??ng s??? kh??ng ???????c ho??n tr??? khi ???? g???i, b???n c?? mu???n ?????t kh??ng?",
                  type: "warning",
                  showCancelButton: true,
                  // confirmButtonColor: '#3085d6',
                  // cancelButtonColor: '#d33',
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "X??c nh???n, ?????t h??ng",

                cancelButtonText: "H???y, quay l???i sau",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("????n h??ng", "????n h??ng c???a b???n ???? ???????c g???i th??nh c??ng", "success");
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,35000);

                      } else {
                        swal("????ng", "????n h??ng ch??a ???????c g???i, h??y ho??n t???t ????n h??ng c???a b???n", "error");

                      }
              
                });

               
            });
        });
    
   </script>


<script type="text/javascript">
    function huydonhang(id){
        var order_code = id;
        var lydo = $('.lydohuydon').val();
        
        var _token = $('input[name="_token"]').val();
       $.ajax({
                        url:"{{url('/huy-don-hang')}}",
                        method:"POST",

                        data:{order_code:order_code, lydo:lydo, _token:_token},
                        success:function(data){
                           
                            alert('????n h??ng hu??? th??nh c??ng');
                            location.reload();

                        }
                    });
        
    }
</script>


<script type="text/javascript">
                // When the user scrolls the page, execute myFunction
        window.onscroll = function() {myFunction()};

        // Get the navbar
        var navbar = document.getElementById("navbarsticky");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          } else {
            navbar.classList.remove("sticky");
          }
        }
</script>


<script type="text/javascript">

    function view(){
        if(localStorage.getItem('data')!=null){

            var data = JSON.parse(localStorage.getItem('data'));

            data.reverse();

            document.getElementById('row_wishlist').style.overflow ='scroll';
            document.getElementById('row_wishlist').style.height ='200px';
            for(i=0;i<data.length;i++){


                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                
                $("#row_wishlist").append('<div class ="row" style="margin:10px 0"><div class ="col-md-4"><img width = "100%" src="'+image+'"> </div><div class ="col-md-8 info_wishlist"><p >'+name+'</p><p style = "color:#FE980F">'+price+'</p><a href= "'+url+'">Xem s???n ph???m</a> </div>' );
              
            }
              $("#delete_wishlist").append('<p><a class="btn btn-danger btn-xs delete_wishlist2" style="margin-top:0">X??a danh s??ch Y??u Th??ch</a></p>' );      
        }
    }
    view();

    function add_wishlist(clicked_id){
        var id = clicked_id;
        var name = document.getElementById('wishlist_productname'+id).value;
        var price = document.getElementById('wishlist_productprice2'+id).value;
        var image = document.getElementById('wishlist_productimage'+id).src;
        var url = document.getElementById('wishlist_producturl'+id).href;
        
        
        var newItem = {
            'url':url,
            'id':id,
            'name':name,
            'price':price,
            'image':image
        }
         

        if(localStorage.getItem('data')==null){
            localStorage.setItem('data','[]');
        }
        

        var old_data = JSON.parse(localStorage.getItem('data'));


        var matches = $.grep(old_data,function(obj){
            return obj.id == id;
        })
        if(matches.length){
            swal("L???i", "S???n ph???m ???? c?? trong danh s??ch y??u th??ch", "error");

                    window.setTimeout(function(){ 
                            location.reload();
                        } ,5000);

        }else{
            old_data.push(newItem);
            $("#row_wishlist").append('<div class ="row" style="margin:10px 0"><div class ="col-md-4"><img width = "100%" src="'+newItem.image+'"> </div><div class ="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style = "color:#FE980F">'+newItem.price+'</p><a href= "'+newItem.url+'">Xem s???n ph???m</a></div>');   
        }
        localStorage.setItem('data',JSON.stringify(old_data));
    }

$(document).on('click','.delete_wishlist2',function(event){
                event.preventDefault(); // nh???ng h??nh ?????ng m???c ?????nh c???a s??? ki???n s??? k x???y ra
                var id = $(this).data('id');
                
                
                if (localStorage.getItem('data') != null) {
                    var data = JSON.parse(localStorage.getItem('data'));
                    if (data.length) {
                            for (i = 0; i < data.length; i++) {
                                if (data[i].id == id) {
                                data.splice(i,1); //x??a ph???n t??? kh???i m???ng, tham s??? th??? 2 l?? 1 ph???n t???
                            }
                        }
                    }
                    
                    localStorage.removeItem('data',JSON.stringify(data));  //chuy???n obj->string
                    swal("X??a", "???? x??a danh s??ch", "success");
                    window.setTimeout(function(){ 
                            location.reload();
                        } ,2000);
                }
            });



</script>



<script type="text/javascript">


    function remove_background(product_id)
    {
        for(var count = 1;count <=5;count++)
        {
            $('#'+product_id + '-' + count).css('color','#ccc');
        }
    }
//nhap chuot danh gia
    $(document).on('mouseenter','.rating',function(){
        var index = $(this).data("index");

        var product_id = $(this).data('product_id');

        remove_background(product_id);

        for(var count =1 ; count<= index;count++)
        {
            $('#'+ product_id + '-' + count).css('color','#ffcc00');
        }

    }); 
//nha chuot ko danh gia
$(document).on('mouseleave','.rating',function(){

        var index = $(this).data("index");

        var product_id = $(this).data('product_id');

        var rating  = $(this).data("rating");

        remove_background(product_id);

        for(var count =1 ; count<= rating; count++) 
        {
            $('#'+ product_id + '-' + count).css('color','#ffcc00');
        }

    }); 

//danh gia sao
    $(document).on('click','.rating',function(){
        
        var index = $(this).data("index");

        var product_id = $(this).data('product_id');

        var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{url('insert-rating')}}",
        method:"POST",
        data:{index:index,product_id:product_id,_token:_token},
        success :function(data)
        {
            if (data=='done') 
            {
                // alert("C??m ??n b???n ???? d??nh gi?? " + index + " tr??n 5");
                swal("????nh gi??", "C??m ??n b???n ???? d??nh gi?? " + index + " tr??n 5 sao", "success");
            }
            else
            {
                swal("L???i", "L???i ????nh gi??", "error");
            }
        }

    });

    });
</script>


<script type="text/javascript">
    function delete_compare(id)
    {
        if(localStorage.getItem('compare')!=null){
            var data = JSON.parse(localStorage.getItem('compare'));
            var index = data.findIndex(item => item.id === id);
            data.splice(index, 1);
                localStorage.setItem('compare', JSON.stringify(data));

                document.getElementById("row_compare"+id).remove();
        }
    }

    sosanh();
    function sosanh()
    {
        if(localStorage.getItem('compare')!=null){

            var data = JSON.parse(localStorage.getItem('compare'));
            
            for(i=0;i<data.length;i++)
            {
                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                // var content = data[i].content;
                var id = data[i].id;

                $('#row_compare').find('tbody').append(`
                    <tr id="row_compare`+id+`">
                        <td>`+name+`</td>
                        <td>`+price+`</td>                       
                        <td><img width="200px" src="`+image+`"></td>
                        <td></td>
                        <td><a href="`+url+`"> <i style="color:green" class="fa fa-eye text-success text-active"></i></a><br></td>
                        <td><a style="cursor:pointer" onclick="delete_compare(`+id+`) "> <i style="color:red" class="fa fa-times text-danger text"></i></a></td>
                    </tr>
                    `)

            }
           
        }
    }

    function add_compare(product_id){
        document.getElementById('title-compare').innerText = 'B???n ch??? c?? th??? so s??nh t???i ??a 3 s???n ph???m m???t l??c';
        var id = product_id;
        var name = document.getElementById('wishlist_productname'+id).value;
        var content = document.getElementById('wishlist_productcontent'+id).value;
        var price = document.getElementById('wishlist_productprice2'+id).value;
        var image = document.getElementById('wishlist_productimage'+id).src;
        var url = document.getElementById('wishlist_producturl'+id).href;

        var newItem = {
            'url':url,
            'id':id,
            'name':name,
            'price':price,
            'image':image
            // 'content':content
        }

        if(localStorage.getItem('compare')==null){
            localStorage.setItem('compare', '[]');
        }

        var old_data = JSON.parse(localStorage.getItem('compare'));

        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })

    if(matches.length){
        alert('S???n ph???m ???? c?? trong danh s??ch so s??nh, kh??ng th??? th??m ti???p!!!');
    }else{
        if(old_data.length<=2){
            old_data.push(newItem);

            $('#row_compare').find('tbody').append(`
                <tr id="row_compare`+id+`">
                        <td>`+newItem.name+`</td>
                        <td>`+newItem.price+`</td>                      
                        <td><img width="200px" width="100%" src="`+newItem.image+`"></td>
                        <td></td>
                        <td><a href="`+url+`"> <i style="color:green" class="fa fa-eye text-success text-active"></i></a></td>
                        <td><a style="cursor:pointer" onclick="delete_compare(`+id+`) "> <i style="color:red" class="fa fa-times text-danger text"></i></a></td>

                </tr>
                    `)
        }
        else{
            alert('B???n c???n lo???i b??? 1 s???n ph???m ????? c?? th??? th??m ti???p');
        }
    }

    localStorage.setItem('compare', JSON.stringify(old_data));
    $('#sosanh').modal();
}


</script>


  <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('L??m ??n ?????t nh??? h??n ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                    text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem ti???p",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "??i ?????n gi??? h??ng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }

                
            });
        });
    </script>
{{-- chon noi van chuyen --}}
<script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>


   {{--  tinh phi van chuyen --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('L??m ??n ch???n ?????y ????? th??ng tin ????? t??nh ph?? v???n chuy???n');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload(); 
                    }
                    });
                } 
        });
    });
    </script>

{{-- xac nhan don hang ajax --}}

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101637072692621");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

{{-- auto compelte --}}
<script type="text/javascript">
     $('#keywords').keyup(function(){
            var query = $(this).val();

                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{url('/autocomplete-search')}}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                        }
                    });

                }else{
                    $('#search_ajax').fadeOut();
                }
        });

        $(document).on('click','.li_search_ajax', function(){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        
        load_comment();

        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                        url:"{{url('/load-comment')}}",
                        method:"POST",
                        data:{product_id:product_id, _token:_token},
                        success:function(data){
                           
                            $('#comment_show').html(data);
                        }
                    });
        }
        $('.send-comment').click(function(){
            
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
             var comment_content = $('.comment_content').val();
             var _token = $('input[name="_token"]').val();
             $.ajax({
                        url:"{{url('/send-comment')}}",
                        method:"POST",
                        data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token}, 
                        success:function(data){
                           
                            $('#notify_comment').html('<span class="text text-success">Th??m b??nh lu???n th??nh c??ng, ??ang ch??? duy???t!!!</span>');
                            $('#notify_comment').fadeOut(9000);
                            $('.comment_name').val();
                            $('.comment_content').val();
                            load_comment();
                        }
                    });
        });
    });  
</script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    var usd = document.getElementById("vnd_to_usd").value; 
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AfP6ig-D7_uUKsFc6WHkH87v0H6ZRh9y9RNFQdRFltUTva__DBo_aPm-cAIabjwxDovUtVVBKIzZfcV7',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: `${usd}`,
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        swal("????n h??ng", "Thanh to??n ????n h??ng th??nh c??ng", "success");
      });
    }
  }, '#paypal-button');



</script>

</body>
</html>
