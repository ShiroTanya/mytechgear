
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">
<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" async defer></script>
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css"/>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
 --}}</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->



<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/2.png')}}">
                <span class="username">


                        <?php
                    $name = Auth::user()->admin_name;
                    if($name){
                        echo $name;
                        
                    }
                    ?>   


                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
@impersonate
                <li>                   
                        <a href="{{URL::to('/impersonate-destroy')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Ng???ng chuy???n quy???n</a>
                    
                </li>
@endimpersonate
                <li><a href="#"><i class=" fa fa-suitcase"></i>Th??ng tin c?? nh??n</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> C??i ?????t </a></li>

                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> ????ng xu???t </a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>T???ng quan</span>
                    </a>
                </li>

                <li>
                    <a  href="{{URL::to('/information')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>Th??ng tin website</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Th????ng hi???u s???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand-product')}}">Th??m th????ng hi???u</a></li>
                        <li><a href="{{URL::to('/all-brand-product')}}">Li???t k?? c??c th????ng hi???u</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bars"></i>
                        <span>Danh m???c s???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-product')}}">Th??m danh m???c s???n ph???m</a></li>
                        <li><a href="{{URL::to('/all-category-product')}}">Li???t k?? danh m???c s???n ph???m</a></li>
                    </ul>
                </li>

                                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-bag"></i>
                        <span>S???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-product')}}">Th??m s???n ph???m</a></li>
                        <li><a href="{{URL::to('/all-product')}}">Li???t k?? c??c s???n ph???m</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-picture-o"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-slider')}}">Th??m slider</a></li> 
                        <li><a href="{{URL::to('/manage-slider')}}">Li???t k?? slider</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-percent"></i>
                         <span>M?? gi???m gi??</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/insert-coupon')}}">Th??m m?? gi???m gi??</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>
                    </ul>
                </li>

            {{--     <li class="sub-menu">
                    <a href="javascript:;">
                        <span>V???n chuy???n</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Qu???n l?? v???n chuy???n</a></li>
                    </ul>
                </li> --}}

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-truck"></i>
                        <span>????n h??ng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Qu???n l?? ????n h??ng</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Qu???n l?? b??i vi??t</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-post')}}">Th??m danh m???c b??i vi???t</a></li>
                        <li><a href="{{URL::to('/add-post')}}">Th??m b??i vi???t</a></li>                       
                        <li><a href="{{URL::to('/all-category-post')}}">Li???t k?? danh m???c b??i vi???t</a></li>
                        <li><a href="{{URL::to('/all-post')}}">Li???t k?? b??i vi???t</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-commenting"></i>
                        <span>B??nh lu???n</span>
                    </a>
                    <ul class="sub">
                        
                        <li><a href="{{URL::to('/comment')}}">Li???t k?? b??nh lu???n</a></li>
                    </ul>
                </li>



@hasrole(['admin','author'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Qu???n l?? t??i kho???n</span>
                    </a>
                    <ul class="sub">
                         {{-- <li><a href="{{URL::to('/add-users')}}">Th??m t??i kho???n</a></li> --}}
                        <li><a href="{{URL::to('/users')}}">C???p nh???t</a></li>
                      
                    </ul>
                </li>
@endhasrole

{{-- @impersonate
 <li>                   
                        <span><a href="{{URL::to('/impersonate-destroy')}}">Ng???ng chuy???n quy???n</a></span>
                    </a>
                </li>
@endimpersonate --}}

            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
            @yield('admin_content')
        
    </section>
 <!-- footer -->
          <div class="footer">
            <div class="wthree-copyright">
                <p>?? 2022 Visitors. All rights reserved | Custom by Ph???m Ho??ng Long</p>
            </div>
          </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
{{-- <script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script> --}}
<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
             var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url : '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });
        $('.add_delivery').click(function(){

           var city = $('.city').val();
           var province = $('.province').val();
           var wards = $('.wards').val();
           var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
           // alert(city);
           // alert(province);
           // alert(wards);
           // alert(fee_ship);
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                   fetch_delivery();
                }
            });


        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
    })


</script>


<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){
         var comment_status = $(this).data('comment_status');

         var comment_id = $(this).data('comment_id');
         var comment_product_id = $(this).attr('id');
        
         if(comment_status == 0){
            var alert = 'Duy???t th??nh c??ng';

         }else{
            var alert = 'Kh??ng duy???t b??nh lu???n';

         }
         $.ajax({
                url : '{{url('/allow-comment')}}',
                method: 'POST',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    $('#notify_comment').html('<span class= "text text-alert" >'+ alert +'</span>');
                }
            });

    });
    $('.btn-reply-comment').click(function(){
         var comment_id = $(this).data('comment_id');

         var comment = $('.reply_comment_'+ comment_id).val();

         

         var comment_product_id = $(this).data('product_id');
        
         // alert(comment);
         // alert(comment_id);
         // alert(comment_product_id);
         
         $.ajax({
                url : '{{url('/reply-comment')}}',
                method: 'POST',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                },
                data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    $('.reply_comment_'+ comment_id).val(''); 
                    $('#notify_comment').html('<span class= "text text-alert" >Tr??? l???i b??nh lu???n th??nh c??ng </span>');
                }
            });

    });

</script>


<script type="text/javascript">
   $( function() {
     $( "#datepicker" ).datepicker({
     prevText:"Th??ng tr?????c",
     nextText:"Th??ng sau",
     dateFormat:"yy-mm-dd",
     dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
     duration: "slow"
         });
     $( "#datepicker2" ).datepicker({
     prevText:"Th??ng tr?????c",
     nextText:"Th??ng sau",
     dateFormat:"yy-mm-dd",
     dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
     duration: "slow"
    });
});

</script>


<script type="text/javascript">
      $(document).ready(function(){

        chart30daysfilter();

        var chart = new Morris.Bar({
            
              element: 'bar-chart',
              lineColors: ['#819C79','#fc8710','FF6541','#A4ADD3','#766B56'],
              barColors: ["#1531B2", "#bf0b29",],
              parseTime: false,
              hideHover:'auto',
              xkey: 'period',
              ykeys: ['order','sales','profit','quantity'],
              labels: ['s??? ????n h??ng','doanh s???','l???i nhu???n','s??? l?????ng SP b??n ra']
            });

        function chart30daysfilter(){    
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/days-order')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},

                success:function(data)
                {                  
                    chart.setData(data);
                }
            });
        }

        $('.dashboard-filter').change(function(){

            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/dashboard-filter')}}",
                method:"POST",
                dataType:"JSON",
                data:{dashboard_value:dashboard_value, _token:_token},

                success:function(data)
                {                  
                    chart.setData(data);
                }
            });
        });



        $('#btn-dashboard-filter').click(function(){          
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();

            $.ajax({

                url:"{{url('/filter-by-date')}}",
                method:"POST",
                dataType:"JSON",
                data:{from_date:from_date, to_date:to_date, _token:_token},

                success:function(data)
                {                  
                    chart.setData(data);
                }

            });

        });
      });
</script>

<script type="text/javascript">
    var colorDanger = "#FF1744";
        Morris.Donut({
          element: 'donut',
          resize: true,
          colors: [
            '#ce616a',
            '#61a1ce',
            '#ce8f61',
            '#f5b942',
            '#4842f5'
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"San pham", value:<?php echo $app_product ?>},
            {label:"Bai viet", value:<?php echo $app_post ?>},
            {label:"Don hang", value:<?php echo $app_order ?>},
            {label:"Khach hang", value:<?php echo $app_customer ?>}
          ]
        });
</script>

<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;
         
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }  
</script>


<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : '{{url('/update-qty')}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
                 
                   location.reload();     
                }
        });

    });
</script>

<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('S??? l?????ng b??n trong kho kh??ng ?????');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#363945');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                 swal("????n h??ng", "Thay ?????i t??nh tr???ng ????n h??ng th??nh c??ng", "success");

                    window.setTimeout(function(){ 
                            location.reload();
                        } ,5000);
                            }
                });
            
        }

    });
</script>

<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
    CKEDITOR.replace('ckeditor4');
    CKEDITOR.replace('ckeditor5');
</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>


<script type="text/javascript">
        
        $.validate({

        }); 

</script>

</body>
</html>