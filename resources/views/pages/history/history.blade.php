@extends('layout')
@section('content')


<div>
  <h2 class="title text-center">Lịch sử đơn hàng</h2>

  <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Xem</th>

            <th style="width:30px;"> Huỷ </th>
          </tr>
        </thead>
        <tbody>
          @php //tang thu tu 1,2,3...
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
            @php 
            $i++;
            @endphp
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $ord->order_code }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>@if($ord->order_status==1)
                    Đơn hàng mới ( chưa xử lý )
                @elseif($ord->order_status==2)
                    <span class="text text-success">Giao hàng thành công</span> 
                @else
                   <span class="text text-danger">Đơn hàng bị huỷ </span> 
                @endif
            </td>
           
            <td>
              <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
              </td>


            <td>
              @if($ord->order_status==1)
              <!-- Trigger the modal with a button -->
             <p><button type="button" style="font-size:10px" data-toggle="modal" data-target="#huydon"><i class="fa fa-times" aria-hidden="true"></i></button></p> 

             @endif()

              <!-- Modal -->
            <div class="row">
              <div id="huydon" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <form>
                    @csrf
                  <!-- Modal content-->
                  <div class="modal-content" style="margin-top: 200px">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Lý do huỷ đơn hàng</h4>
                    </div>
                    <div class="modal-body">
                      <p><textarea rows="5" class="lydohuydon" required placeholder="Lý do huỷ đơn hàng"></textarea></p>
                    </div>
                    <div class="modal-footer">                
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                      <button type="button" id="{{$ord->order_code}}" onclick="huydonhang(this.id)" class="btn btn-success">Xác nhận hủy</button>    
                      <div>                  
                    </div>
                  </div>
                  </form>

                </div>
              </div>
             
            
              
              {{-- <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a> --}}

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   <footer class="panel-footer">
      <div class="row">
          <div class="col-sm-5 text-center">
            
          </div>
          <div class="col-sm-7 text-right text-center-xs">
             <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$order->links()!!}
                      </ul>
          </div>
      </div>
   </footer>
  </div>
</div>
</div>
    
@endsection