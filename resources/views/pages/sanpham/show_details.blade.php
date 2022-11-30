@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
	 <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
						<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
  </ol>
</nav>



						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
								{{-- <h3>ZOOM</h3> --}}
							</div>
						{{-- 	<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">

										<div class="item active">
										  <a href=""><img src="{{URL::to('public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										
										
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> --}}

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Mã ID: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									@csrf
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                          
								<span>
									<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
								
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
								</span>
								<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mơi 100%</p>
								<p><b>Số lượng kho còn:</b> {{$value->product_quantity}}</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<p><b>Danh mục:</b> {{$value->category_name}}</p>

								<style type="text/css">
									a.tags_style{
										margin: 3px 2px;
										border: 1px solid;

										height: auto;
										background: #428bca;
										color: #ffff;
										padding: 0px;
									}
									a.tags_style:hover{
										background: black;
									}
								</style>

								<fieldset>
										<legend>
											Tags
										</legend>
										<p><i class="fa fa-tag"></i>
											@php
												$tags = $value->product_tags;
												$tags = explode(",",$tags);

											@endphp
											@foreach($tags as $tag)

															<a href="{{url('/tag/'.$tag)}}" class="tags_style">{{$tag}}</a>

											@endforeach
 
										</p>
								</fieldset>



								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
							
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
								
						
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									{{-- <ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									 --}}

										<style type="text/css">
										.style_comment {
										border: 1px solid #FF0033;
											border-radius: 10px;
											background: aliceblue;

										}
										</style>


										<form>
											@csrf
											<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
											<div id="comment_show"></div>
 
										</form>
										
										<p><b>Viết đánh giá của bạn</b></p>

										<ul class="list-inline rating " title="Average Rating">
											
											@for($count=1;$count<=5;$count++)
												@php

														if($count<=$rating){
															$color = 'color:#ffcc00;';
														}	

														else {
															$color = 'color:#ccc;';
														}

												@endphp 
											

											<li title="star_rating"
												id="{{$value->product_id}}-{{$count}}"
												data-index ="{{$count}}"
												data-product_id = "{{$value->product_id}}"
												data-rating ="{{$rating}}" 
												class="rating"
												style="cursor: pointer;{{$color}} font-size: 30px;">&#9733;</li>
												@endfor
										</ul>

									<form action="#">
										<span>
											<input style="width:100%;margin-left:0" type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Nhập tên bình luận" class="comment_name" placeholder="Tên bình luận"/>
										</span>
										<div id="notify_comment"></div>
									<span>
										<textarea name="comment" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng không để trống nội đung bình luận" class="comment_content input" placeholder="Nội dung" ></textarea>
									</span>
										<b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right send-comment">
											Gửi bình luận
										</button>						
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach
	<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($relate as $key => $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center product-related">

			                                        <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">
			                                            <img style="height: 150px"src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
			                                            <p>{{$lienquan->product_name}}</p>
			                                            <h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>
			                                            
			                                        </a>
			                                         
		                                        </div>
		                                      
                                			</div>
										</div>
									</div>
							@endforeach		

								
								</div>
									
							</div>
									
						</div>

					</div><!--/recommended_items-->
					  <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$relate->links()!!}
                      </ul>

@endsection