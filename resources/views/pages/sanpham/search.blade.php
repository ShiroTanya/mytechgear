@extends('layout')
@section('content')
               <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>



                        @foreach($search_product as $key =>$product)
                        <input type="hidden" id="wishlist_productprice2{{$product->product_id}}" value="{{number_format($product->product_price,0,',','.')}}VNĐ" class="cart_product_price_2{{$product->product_id}}">
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


                                            <input type="hidden" id="wishlist_productcontent{{$product->product_id}}" value="{{$product->product_content}}">

                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">

                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                                <img id="wishlist_productimage{{$product->product_id}}" height="150px" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.')}}VNĐ</h2>
                                                
                                                <p style="font-size: 13px">{{$product->product_name}}</p>

                                             
                                             </a>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                            </form>
 
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
                                        <li><a style="cursor: pointer;" onclick="add_compare({{$product->product_id}})"><i class="fa fa-plus-square"></i>So sánh</a></li>

                                        <div class="container">

                                            <div class="modal fade" id="sosanh" role="dialog">
                                              <div class="modal-dialog">

                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    
                                                    <button type="button" class="close" data-dismiss="modal">
                                                      &times;
                                                    </button>
                                                    <h4 class="modal-title"><span id="title-compare"></span></h4>
                                                  </div>
                                                  <div class="modal-body"> 
                                                        <table class="table table-hover" id="row_compare">
                                                          <thead class="thead-dark">
                                                            <tr>
                                                              <th >Tên sản phẩm</th>
                                                              <th >Giá</th>
                                                              <th >Hình ảnh</th>
                                                              <th>Thông số</th>
                                                              <th>Hiển thị</th>
                                                              <th>Xóa</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            
                                                          </tbody>
                                                        </table>

                                                    </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>

                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                </div><!--features_items-->

@endsection

