@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Comment
    </div>
    <div id="notify_comment">
      
    </div>
 {{-- <div class="row w3-res-tb">
      
      <div class="col-sm-9">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div> --}}
    <div class="table-responsive">

                          @if($errors->any())
                          <h4>{{$errors->first()}}</h4>
                          @endif
                          
                            <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message', null);
                            }
                            ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Duyệt</th>
            <th>Tên người gửi</th>            
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
           

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key => $comm)
          <tr>
            
            <td>
              @if($comm->comment_status == 1 )
                  <input type="button" data-comment_status ="0" data-comment_id = "{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt bình luận" > 
                  
              @else 
                  <input type="button" data-comment_status ="1" data-comment_id = "{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ duyệt bình luận" >
              @endif            
            </td>

            <td>{{ $comm->comment_name }}</td>


            <td>{{ $comm->comment }}
              <style type="text/css">
                ul.list_rep li {
                  list-style-type: decimal;
                  color: blue;
                  margin: 5px 0px 10px 30px;
}
              </style>
              <ul class="list_rep">
                Trả lời:
                @foreach($comment_rep as $key => $comm_reply)

                  @if($comm_reply ->comment_parent_comment == $comm->comment_id)

                  <li > {{$comm_reply->comment}}</li>
                  @endif

                @endforeach
              </ul>
               @if($comm->comment_status == 0 )
                  <br/><textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="5"></textarea>
                  <br/><button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$comm->comment_product_id}}" data-comment_id="{{$comm->comment_id}} " >Trả lời bình luận</button>
                  
            
                  
              @endif

            </td>

            <td>{{ $comm->comment_date }}</td>
            <td><a href="{{url ('/chi-tiet-san-pham/'.$comm->product->product_slug)}}" target="_blank">{{ $comm->product->product_name }}</a></td>
           

          
            <td>
              
              <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')" href="" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach

        </tbody> 
      </table>

<!-----import data---->
      
    {{-- <footer class="panel-footer">
      <div class="row">
        
        
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$all_product->links()!!}
                      </ul>
        </div>
      </div>
    </footer> --}}
  </div>
</div>
@endsection