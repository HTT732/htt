<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Tin Tức | Giải Trí</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="library/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="image/icon/ico1.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/tintuc_giaitri.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Philosopher&amp;subset=vietnamese" rel="stylesheet">
	{{-- 
	font-family: 'Lobster', cursive;
	font-family: 'Philosopher', sans-serif;
	font-family: 'Cabin Condensed', sans-serif; 
	--}}
</head>
<body>
	<div class="container">
		@include('layouts.client.tintuc-header')
		<div id="content">
			<a id="hiepkhach" href="javascript:void(0)" data-toggle="popover" data-content="Ta là kẻ vô danh." ></a>
			<div class="clearfix"></div>	
			<div class="row m-0">
				@include('layouts.client.tintuc-left')
				<div class="col-12 col-md-8 col-lg-7 order-2 content-middle px-1">

					<div class="middle-top col-12">
						@yield('content')
					</div>

					<div class="col-12 middle-bottom">
						<!-- chứa phần đuôi bg của bg trên -->
					</div>
				</div>
				@include('layouts.client.tintuc-right')
			</div>
		</div> <!-- End content -->
		@include('layouts.client.tintuc-footer')
	</div> <!-- End container -->

	<script src="js/jquery.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->
	<script src="js/popper/popper.min.js"></script>
	<script src="js/bootstrap-js/bootstrap.min.js"></script>
	<script src="js/tintuc_giaitri.js"></script>
</body>
</html>