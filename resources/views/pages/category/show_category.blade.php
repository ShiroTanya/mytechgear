@extends('layout')
@section('content')
               <div class="features_items"><!--features_items-->

                    <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>

                        


                        @foreach($category_name as $key =>$name)
                        <h2 class="title text-center">{{$name->category_name}}</h2>
                        @endforeach


                        {{-- <div class="col-sm-4">
                             <label for="amount">Lọc giá theo</label>

                             <form>
                                <div id="slider-range"></div>
                                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight: bold">
                                <input type="hidden" name="start_price" id="start_price" >
                                <input type="hidden" name="end_price" id="end_price" >
                                <br>
                                <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default">

                            </form> 
                        </div> --}}


                        @foreach($category_by_id as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                           
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                                            @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                                            <input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                                          
                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                                <img id="wishlist_productimage{{$product->product_id}}" height="150px" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.')}}VNĐ</h2>
                                                
                                                <p style="font-size: 13px">{{$product->product_name}}</p>

                                             
                                             </a>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                            </form>

                                            <style type="text/css">
                                                p.qrcode_style{
                                                    position: absolute ;
                                                    top: 2%;
                                                    left: 3%;
                                                }
                                            </style>

                                            @php
                                            $qrcode_url = url('chi-tiet-san-pham/'.$product->product_slug);
                                                
                                            @endphp                                         
                                            <p class="qrcode_style">{{QrCode::size(70)->generate($qrcode_url)}}</p>
 
                                        </div>
                                      
                                </div>
                           
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <style type="text/css">
                                            ul.nav.nav-pills.nav-justified li {
                                                text-align: center;
                                                font-size: 13px;
                                            }
                                            .button_wishlist{
                                                border: none;
                                                background: #ffff;
                                                color: #B3AFA8;
                                            }
                                            ul.nav.nav-pills.nav-justified i{
                                                color: #B3AFA8;
                                            }
                                            .button_wishlist span:hover{
                                                color: #FE980F;
                                            }
                                            .button_wishlist :focus{
                                                border: none;
                                                outline: none;
                                            }

                                        </style>
                                        <li>
                                            <i class="fa fa-plus-square"></i>
                                            <button class="button_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        </a>
                        @endforeach




                </div><!--features_items-->           
               <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>         

               <div class="row">
                    <div class="col-sm-7 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$category_by_id->links()!!}
                      </ul>
                    </div>
                </div>
@endsection

