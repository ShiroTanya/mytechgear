<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<meta name ="viewport" content="width-device-width, initial-scale=1.0">
	<title> Xác nhận đơn hàng </title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="background: #222;border-radius: 12px;padding: 15px;">
		<div class="col-md-12">

			<p style="text-align: center;color: #fff"> Đây là email tự động. Quý khách vui lòng không trả lời email này.</p>

			<div class="row" style="background: cadetblue;padding: 15px">
				<div class="col-md-6" style="text-align: center;color: #fff;font-weight: bold;font-size: 30px">
					<h4 style="margin: 0"> CÔNG TY TNHH CÔNG NGHỆ TECHGEAR </h4>
					<h6 style="margin: 0"> DỊCH VỤ BÁN HÀNG - CUNG ỨNG - NHẬP KHẨU - VẬN CHUYỂN CHUYÊN NGHIỆP </h6>
				</div>

					<div class="col-md-6 logo" style="color: #fff">
						<p>Chào bạn <strong style="color: #000;text-decoration: underline;">{{$shipping_array['customer_name']}}</strong></p>
					</div>

					<div class="col-md-12">
						<p style="color: #fff;font-size: 17px"> Bạn hoặc một ai đó đã sử dụng mail này để đăng ký dịch vụ tại website với thông tin như sau:</p>
						<h4 style="color: #000;text-transform: uppercase;"> Thông tin đơn hàng </h4>
						<p> Mã đơn hàng: <strong style="text-transform: uppercase;color: #fff">{{$code['order_code']}}</strong></p>
						<p> Mã khuyến mãi áp dụng: <strong style="text-transform: uppercase;color: #fff">{{$code['coupon_code']}}</strong></p>
						<p> Phí vận chuyển: <strong style="text-transform: uppercase;color: #fff">{{$shipping_array['fee']}}</strong></p>
						<p> Dịch vụ: <strong style="text-transform: uppercase;color: #fff">Đặt hàng trực tuyến</strong></p>

						<h4 style="color: #000;text-transform: uppercase;"> Thông tin người nhận </h4>
						<p> Email:
							@if($shipping_array['shipping_email']=='')
								<span style="color: #fff"> không có </span>
							@else
								<span style="color: #fff">{{$shipping_array['shipping_email']}}</span>
							@endif
						</p>

						<p> Họ và tên người nhận:
							@if($shipping_array['shipping_name']=='')
								<span style="color: #fff"> không có </span>
							@else
								<span style="color: #fff">{{$shipping_array['shipping_name']}}</span>
							@endif
						</p>

						<p> Địa chỉ nhận hàng:
							@if($shipping_array['shipping_address']=='')
								<span style="color: #fff"> không có </span>
							@else
								<span style="color: #fff">{{$shipping_array['shipping_address']}}</span>
							@endif
						</p>

						<p> Số điện thoại:
							@if($shipping_array['shipping_phone']=='')
								<span style="color: #fff"> không có </span>
							@else
								<span style="color: #fff">{{$shipping_array['shipping_phone']}}</span>
							@endif
						</p>

						<p> Ghi chú đơn hàng:
							@if($shipping_array['shipping_notes']=='')
								<span style="color: #fff"> không có </span>
							@else
								<span style="color: #fff">{{$shipping_array['shipping_notes']}}</span>
							@endif
						</p>

						<p> Hình thức thanh toán: <strong style="text-transform: uppercase; color: #fff">
							@if($shipping_array['shipping_method']=='')
								ATM
							@else
								Tiền mặt
							@endif
						</strong></p>

						<p style="color: #fff"> >>>>Nếu thông tin người nhận hàng không có chúng tôi sẽ liên hệ với người đặt để trao đổi về đơn hàng mà bạn đã đặt mua<<<< 	</p>

						<h4 style="color: #fff;text-transform: uppercase;">Sản phẩm đã đặt mua: </h4>

						<table class="table table-striped" style="border: 1px">
							<thead>
								<tr>
									<th> Sản phẩm </th>
									<th> Giá tiền </th>
									<th> Số lượng </th>
									<th> Thành tiền </th>
								</tr>
							</thead>
							<tbody>
								@php
								$sub_total = 0;
								$total = 0;
								@endphp

								@foreach($cart_array as $cart)
									@php
									$sub_total = $cart['product_qty']*$cart['product_price'];
									$total +=$sub_total;
									@endphp

									<tr>
										<td>{{$cart['product_name']}}</td>
										<td>{{number_format($cart['product_price'],0,',','.')}}VND</td>
										<td>{{$cart['product_qty']}}</td>
										<td>{{number_format($sub_total,0,',','.')}}VND</td>
									</tr>
								@endforeach

								<tr>
									<td colspan="4" align="right">Tổng thanh toán: {{number_format($total,0,',','.')}}VND</td>
								</tr>
							</tbody>
						</table>
					</div>

					<p style="color: #fff"> Mọi chi tiết xin liên hệ tại website: <a target="_blank" href="http://techgear.com/techgear">Shop</a>, hoặc liên hệ qua hotline: 0961247427.Xin cảm ơn quý khách đã đặt mua qua website của chúng tôi. Trân trọng !!! </p>
		</div>
	</div>
</div>
</body>
</html>