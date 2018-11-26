<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng ký</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 col-lg-8 col-xl-7 mx-auto register">
				@if($errors->count() > 0)
					<div id="modal-canhbao" class="modal d-block" tabindex="-1" id="modal-1">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Cảnh báo</h4>
									<button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
								</div>
								<div class="modal-body">
									@foreach($errors->all() as $err)
									<li class="text-danger">{{ $err }}</li>
									@endforeach
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				@endif
				<form  class="col-9 col-sm-6  mx-auto" method="post" action="{{ route('postdangky') }}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group row">
						<label class="label">Tên tài khoản</label>
						<input type="text" name="username" class="col-10 form-control username" maxlength="25" required placeholder="Nhập tài khoản" pattern="[a-zA-Z0-9]{6,25}"  autofocus oninvalid="UsernameInvalidMsg(this);" oninput="UsernameInvalidMsg(this);">
						<span class="col-2 checkOk" style="background:url('image/ok.png') center no-repeat;background-size:70% 70%; display: none;"></span>
						<span class="col-2 checkFaild" style="background:url('image/khong.png') center no-repeat;background-size:70% 70%;opacity: 0.9; display: none;"></span>
					</div>
					<div class="form-group row">
						<label class="label">Mật khẩu</label>
						<input id="username" type="password" name="password" class="form-control col-10 password" maxlength="50" required placeholder="Nhập mật khẩu" pattern=".{6,}" oninvalid="PasswordInvalidMsg(this);" oninput="PasswordInvalidMsg(this);"/>
						<label style="font-size: 0.8em; font-weight: 500;">Mật khẩu phải nhiều hơn 6 ký tự</label>
					</div>
					<div class="form-group row">
						<label class="label">Xác nhận mật khẩu</label>
						<input type="password" name="re_password" class="form-control col-10 re_password" maxlength="50" required placeholder="Nhập lại mật khẩu">
						<span class="col-2 checkOk" style="background:url('image/ok.png') center no-repeat;background-size:70% 70%;display: none;"></span>
						<span class="col-2 checkFaild" style="background:url('image/khong.png') center no-repeat;background-size:70% 70%;opacity: 0.9;display: none;"></span>
					</div>
					<div class="form-group row">
						<label class="custom-control custom-checkbox">
    					<input type="checkbox" class="custom-control-input" required>
    					<label class="custom-control-indicator"></label>
    					<span class="custom-control-description text-muted">Ta đã sẵn sàng phiêu bạt giang hồ.</span>
    					
					</div>
					<div class="form-group row">
 						<button type="submit" class="btn btn-outline-secondary">Đăng ký</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/popper/popper.min.js"></script>
	<script src="js/bootstrap-js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			var check_faild_repass = true;
			var check_faild_user = true;
			$('input').on('blur', function(){
				var data = $(this).val();
				var pattern = /^[a-zA-Z0-9]{6,}$/;
				var CSRF_TOKEN = $("input[name='_token']").attr('value'); //Lấy token từ form để truyền đi
				if ((data.trim() == '' || !pattern.test(data)) && !$(this).hasClass('re_password')){
					$(this).parent().find('.checkOk').hide();
					$(this).parent().find('.checkFaild').show();
					check_faild_user = false;
				}
				else if ($(this).hasClass('username')){
					$.ajax({
						'url' : 'check-username', // Route::post  check-username
						'type' : 'POST',
						'data': { // gửi token + data cần check
							_token: CSRF_TOKEN,
							'username' : data
						},
						success: function (data) {
							if (data == 0){
								$('.username').parent().find('.checkFaild').hide();
								$('.username').parent().find('.checkOk').show();
								check_faild_user = true;
							}
							else {
								$('.username').parent().find('.checkOk').hide();
								$('.username').parent().find('.checkFaild').show();
								check_faild_user = false;
							}

						}
					});
				}
				else if ($(this).hasClass('re_password') || $(this).hasClass('password')){
					var pass = $('.password').val();
					var re_pass = $('.re_password').val();
					if (re_pass == pass && pass != '' && re_pass.length >= 6 && pass.length >= 6){
						$('.re_password').parent().find('.checkFaild').hide();
						$('.re_password').parent().find('.checkOk').show();
						check_faild_repass = true;
					}
					else if (re_pass != ''){
						$('.re_password').parent().find('.checkOk').hide();
						$('.re_password').parent().find('.checkFaild').show();
						check_faild_repass = false;
					}
				}
			});
			$('input').on('keyup', function(){
				$(this).parent().find('.checkFaild').fadeOut();
			});
				// $('button[type="submit"]').click(function(){
				// 	if (check_faild_user == false || check_faild_repass == false){
				// 		alert('Vui lòng nhập đúng thông tin trước khi gửi');
				// 		return false;
				// 	}
				// })

			$('.close-modal').click(function(){
				$('.modal').removeClass('d-block');
			});

		});
	//Custom title của patterrn
	function UsernameInvalidMsg(textbox) {
	    if(textbox.validity.patternMismatch){
	        textbox.setCustomValidity('Tài khoản phải dài hơn 6 ký tự và không thể chứa ký tự đặc biệt');
	    }    
	    else {
	        textbox.setCustomValidity('');
	    }
	    return true;
	}
	function PasswordInvalidMsg(textbox) {
		if(textbox.validity.patternMismatch){
	        textbox.setCustomValidity('Mật khẩu phải dài hơn 6 ký tự');
	    }    
	    else {
	        textbox.setCustomValidity('');
	    }
	    return true;
	}

	// Disable Space
	$(function(){
		$('input').on('keydown', function(e){
			return e.which != 32;
		});
	});
	</script>
</body>
</html>