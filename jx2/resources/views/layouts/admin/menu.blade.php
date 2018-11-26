<!-- Menu quản lý -->
<div id="menu" class="col col-9 col-sm-4 col-md-4 col-lg-3 col-xl-2">
	<div class="row flex-column">
		<div class="accordion " id="card-menu">
			<!-- Link -->
			<div class="card ">
				<div class="card-header ">
					<div data-toggle="collapse" data-target="#ql_sanpham">
						<span><i class="fas fa-cart-arrow-down"></i>Quản lý sản phẩm</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_sanpham" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('sanpham') }}"><i class="fas fa-angle-double-right"></i>Danh sách sản phẩm</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->

			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_baiviet">
						<span><i class="fas fa-feather-alt"></i>Quản lý bài viết</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_baiviet" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('baiviet') }}"><i class="fas fa-angle-double-right"></i>Danh sách bài viết</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->
			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_slider">
						<span><i class="fas fa-sliders-h"></i>Quản lý slider</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_slider" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('slide') }}"><i class="fas fa-angle-double-right"></i>Danh sách slide</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->
			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_thanhvien">
						<span><i class="fas fa-user"></i>Quản lý thành viên</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_thanhvien" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('user') }}"><i class="fas fa-angle-double-right"></i>Danh sách thành viên</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->

			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_comment">
						<span><i class="fas fa-comments"></i>Quản lý comment</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_comment" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('comment') }}"><i class="fas fa-angle-double-right"></i>Danh sách comment</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->

			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_tinnhan">
						<span><i class="fas fa-envelope"></i>Quản lý tin nhắn</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_tinnhan" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('message') }}"><i class="fas fa-angle-double-right"></i>Danh sách tin nhắn</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->

			<!-- Link -->
			<div class="card">
				<div class="card-header">
					<div data-toggle="collapse" data-target="#ql_thongke">
						<span><i class="fas fa-signal"></i>Quản lý thống kê</span>
						<i class="fas fa-caret-right"></i>
					</div>
				</div>
				<!-- Sub link -->
				<div id="ql_thongke" class="collapse" data-parent="#card-menu">
					<div class="card-body">
						<ul class="nav">
							<li>
								<a href="{{ route('thongke') }}"><i class="fas fa-angle-double-right"></i>Số lượng Like</a>
							</li>
							<li>
								<a href="{{ route('thongke') }}"><i class="fas fa-angle-double-right"></i>Số lượng comment</a>
							</li>
							<li>
								<a href="{{ route('thongke') }}"><i class="fas fa-angle-double-right"></i>Số lượng xem</a>
							</li>
							<li>
								<a href="{{ route('thongke') }}"><i class="fas fa-angle-double-right"></i>Thống kê IP</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End sub link -->
			</div>
			<!-- End link -->
		</div>
	</div>
</div>
<!-- End menu -->