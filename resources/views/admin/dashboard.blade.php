@extends('admin_layout')

@section('admin_content')
<div class=container-fluid">
	<style type="text/css">
		p.title_thongke {
			text-align: center;
			font-size: 20px;
			font-weight: bold;
		}

		ol.list_views
		{
			margin: 10px 0;
			color: #fff;
		}

		ol.list_views a
		{
				font-weight: 400;
				color: #A4ADD3;
		}
		table.table.table-bordered.table-dark{
		background: #32383e
		}
		table.table.table-bordered.table-dark tr th{
			color: #fff
		}
	</style>


<div class="row">
	<p class="title_thongke" style="font-size: 30px;">Thống kê đơn hàng & doanh số</p>

	<form autocomplete="off">
		@csrf
 
		<div class="col-md-2">
			<p> Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
			<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
		</div>

		<div class="col-md-2">
			<p> Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
		</div>

		<div class="col-md-2">
			<p> Lọc theo: 
				<select class="dashboard-filter form-control">
					<option>--Chọn--</option>
					<option value="7ngay">--7 ngày qua--</option>
					<option value="thangnay">--tháng này--</option>
					<option value="thangtruoc">--tháng trước--</option>
					<option value="365ngayqua">--365 ngày--</option>					
				</select>
			</p>			
		</div>

	</form>

		<div class="col-md-12">
			<div id="bar-chart" style="height: 350px;"></div>
		</div>

</div>

{{-- <div class="row">

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Đang online</th>
      <th scope="col">Tổng tháng này</th>
      <th scope="col">Tổng tháng trước</th>
      <th scope="col">Tổng cả năm</th>
      <th scope="col">Tổng truy cập</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$visitor_count}}</td>
      <td>{{$visitor_this_month_count}}</td>
      <td>{{$visitor_last_month_count}}</td>
      <td>{{$visitor_year_count}}</td>
      <td>{{$visitor_total}}</td>

    </tr>
  </tbody>
</table>

</div> --}}

<div class="row" style="margin-top: 50px">
	<div class="col-md-4 col-xs-12">
		<p class="title_thongke" style="font-size: 24px;">Tổng Sản phẩm/Khách hàng/Đơn hàng/Bài viết</p>
		<div id="donut"></div>
	</div>

	<div class="col-md-4 col-xs-12">
		<p class="title_thongke" style="font-size: 24px; margin-right: 150px">Bài viết xem nhiều</p>
		<ol class="list_views">
			@foreach($post_views as $key => $post)
			<li>
				<a  target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} | 
					<span style="color: black">{{$post->post_views}}</span>
				</a>
			</li>
			@endforeach
		</ol>
	</div>

	<div class="col-md-4 col-xs-12">
		<p class="title_thongke" style="font-size: 24px; margin-right: 250px">Sản phẩm xem nhiều</p>
		<ol class="list_views">
			@foreach($product_views as $key => $pro)
			<li>
				<a  target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_slug)}}">{{$pro->product_name}} | 
					<span style="color: black">{{$pro->product_views}}</span>
				</a>
			</li>
			@endforeach
		</ol>
	</div>

</div>

@endsection