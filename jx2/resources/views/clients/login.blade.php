<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="device-width, initial-scale=1"/>
	<title>Đăng nhập</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="container-fluid">
  		<div class="col-11 col-sm-6 col-md-5 col-lg-4 col-xl-3 mx-auto text-center">
  			<div class="alert alert-light py-2 px-3 mt-1" style="font-size: 0.9em">Nếu bạn chưa có tài khoản hãy <a href="{{ route('dangky' )}}"><strong>đăng ký</strong></a></div>
  		</div>
	  	<div class="row">
	  		<div class="col-12 col-sm-10 col-md-9 mx-auto">
				<form class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4 mx-auto  text-center" method="post" action="{{ route('dangnhap' )}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@if(session('login_faild'))
			  			<div class="alert alert-danger form-control text-left">
			  				<li>{{ session('login_faild') }}</li>
			  			</div>
			  		@elseif($errors->count() > 0)
						<div class="alert alert-danger form-control text-left">
				  			@foreach($errors->all() as $err)
				  				<li>{{ $err }}</li>
				  			@endforeach
			  			</div>
		  			@endif
					<div class="form-group" method="post">
					    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nhập tài khoản" autofocus name="username" required value="{{ old('username') }}">
					</div>
				  	<div class="form-group">
					    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Nhập mật khẩu" name="password" required>
					</div>
					<input id="submit" type="submit" name="submid" class="btn btn-dark" value="Đăng nhập">
				</form>
	  		</div>
	  	</div>
  	</div>
	<script src="js/jquery.js"></script>
	<script src="js/popper/popper.min.js"></script>
	<script src="js/bootstrap-js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			var height =screen.availHeight;
			var setHeight = Math.round(height/5);
			$('form').css('transition', '1s');
			$('form').css('margin-top', setHeight);
			
			setTimeout(function(){
				$('.alert-light').fadeIn();
			}, 1500);
		});
	</script>
</body>
</html>