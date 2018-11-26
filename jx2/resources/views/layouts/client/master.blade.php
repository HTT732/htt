<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Account Sơn Trang</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/posts-style.css">
	<link rel="stylesheet" href="library/fontawesome-5.5.0/css/all.css">
	<link rel="shortcut icon" href="image/icon/ico1.ico" type="image/x-icon"/>

</head>
<body>
	<div class="container">
		@include('layouts.client.header')
		<div class="content">
			@include('layouts.client.menu')
			<div class="posts">
				<div class="container row m-0 p-0">
					@yield('detail')
					<div class="col col-12 col-lg-9 content-left">
						<div class="row m-0">
							@yield('content')
						</div>
					</div> <!-- End col-8 -->

					@include('layouts.client.right')
				</div> <!-- End row -->
			</div> <!-- End posts -->
		</div> <!-- End content -->
		@include('layouts.client.footer')
	</div>	<!-- End container -->

	<script src="js/jquery.js"></script>
	<script src="js/popper/popper.min.js"></script>
	<script src="js/bootstrap-js/bootstrap.min.js"></script>
	<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
	<script src="js/posts.js"></script>
</body>
</html>