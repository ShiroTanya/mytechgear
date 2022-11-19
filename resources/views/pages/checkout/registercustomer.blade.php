<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login V5</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" action="{{URL::to('/add-customer')}}"
					method="POST">
					@csrf
					<span class="login100-form-title p-b-53">
						Đăng ký tài khoản
					</span>

					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Email
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Không được để trống tên đăng nhập">
						<input class="input100" type="text" name="customer_email" placeholder="Nhập email">
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Mật khẩu
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Không được để trống mật khẩu">
						<input class="input100" type="password" name="customer_password" placeholder="Nhập mật khẩu">
						<span class="focus-input100"></span>
					</div>


					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Họ và Tên
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Không được để trống mật khẩu">
						<input class="input100" type="text" name="customer_name" placeholder="Họ tên">
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Số điện thoại
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Không được để trống mật khẩu">
						<input class="input100" type="text" name="customer_phone" placeholder="Số điện thoại">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn m-t-17">
						<button type="submit" class="login100-form-btn">
							Đăng ký
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Chưa có tài khoản?
						</span>

						<a href="{{URL::to('/login-checkout')}}" class="txt2 bo1">
							Quay lại
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>