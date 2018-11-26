<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="_token" content="{{ csrf_token() }}">
	<base href="{{asset('')}}">
	<title>Jx2 - Hoàng Thái Trung</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="image/icon/ico1.ico" type="image/x-icon" />
	{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> --}}
	<link rel="stylesheet" href="library/fontawesome-5.5.0/css/all.css">
	<script src="ckeditor/ckeditor.js"></script>
</head>
<body>
	{{-- Thông báo lỗi đăng nhập phát sinh --}}
	@if (session('error_login'))
		<div class="alert alert-danger text-center">Dường như có lỗi đăng nhập. Bạn hãy thử lại.</div>
	@endif
	<div class="container"> <!-- Container -->
		<div class="card my-card rounded-0 mx-auto"> <!-- card -->
			<div class="card-header rounded-0">
				<!-- Login and register -->
				<nav class="navbar justify-content-between p-0">
					{{-- <label class="m-0">Jx2 - Hoàng Thái Trung</label> --}}
					<div style="height:27px;width:100px;background:url('image/jx23.png') no-repeat;opacity:0.7;background-size:100% 100%"></div>
					<span class="label label-default">
						@if(!Auth::check())
							<a type="button" href="{{ route('dangnhap')}}" class="btn btn-sm btn-login"><small><strong>Đăng nhập</strong></small></a>
							<a type="button" href="{{ route('dangky')}}" class="btn btn-sm btn-register"><small ><strong>Đăng ký</strong></small></a>
						@else
							<button type="button" class="btn btn-sm btn-info-user bg-light"><strong>{{ Auth::user()->username }}</strong></button>
							@if(Auth::user()->level > 1)
								<a type="button" href="{{ route('sanpham')}}" target="_blank" class="btn btn-sm btn-register"><small ><strong>Trang Admin</strong></small></a>
							@endif
						    <button id="btn-close" href="#logout" class="btn btn-outline-secondary btn-sm my-sm-0" data-toggle="modal" type="button">&times;</button>
						@endif
					</span>
				</nav>
				<!--Modal Logout -->
				<div class="modal fade " id="logout">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Đại hiệp muốn rời khỏi đây sao !</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
							</div>
							<div class="modal-footer">
								<a type="button" href="{{ route('dangxuat') }}" class="btn btn-primary">Ta có việc phải làm.</a>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
				<!-- End modal logout -->
			</div>
			<div class="card-body my-card-body p-0">
				<!-- chay ngang man hinh -->
				<div class="marquee col col-8 mx-auto mt-4" style="background:#DCD9BB;opacity: 0.4;height:22px;">
				</div>
				<div class="marquee col col-8 mx-auto" style="margin-top:-23px">
					@if(isset($marquee))
						<marquee style="color:blue;font-weight: bold;opacity: 0.8;">{!! $marquee->noidung !!}</marquee>
					@else
						<marquee style="color:blue;font-weight: bold;opacity: 0.8;">Cung nghênh đại hiệp đến với Jx2 - HTT.</marquee>
					@endif
				</div>
				
				@if(Auth::check())
				<!-- Quản lý bài viết -->
				<div class="p-0 col-md-11 mx-auto" >
					<div class="card baiviet" data-hidden="all">
						<div class="card-header navbar justify-content-between pb-0">
							<ul class="nav nav-tabs border-0" role="tablist">
								<li class="nav-item mx-1" >
									<a href="#" id="control-baiviet" role="tab" class="nav-link active" data-toggle="tab">Bài viết đã đăng</a>
								</li>
								<li class="nav-item" id="control-dangbai">
									<a href="" class="nav-link " data-toggle="tab">Đăng bài</a>
								</li>
							</ul>
							<button class="btn btn-outline-secondary btn-sm btn-close-control">&times;</button>
						</div>	
						<div id="scroll" class="card-body">
							<p id="iconLoadSanPham" class="text-center mt-2" style="display: none;"><i class="fa fa-spinner fa-4x fa-pulse"></i></p>
							<div class="noidungbaiviet row m-0" >
								{{-- List danh sach san pham --}}
								<!-- <div class="col col-4 col-md-4 col-lg-3">
									<div class="card">
										<div id="cardHeader">
											<a href="" data-toggle="modal" >
												<img class="thumbnail-san-pham" style="background:url('upload/source_resize/1541314896.2game_13_7_VLTK2_1.jpg')">
											</a>
											<i class=""></i>
										</div>
										<div id="scrollStyle1" class="card-body"> 
												<div class="form-inline float-left"> 
													<i class="fas fa-users"></i>
													<span>20</span>
												</div>
												<div class="form-inline float-right">
													<i class="fas fa-thumbs-up"></i>
													<span>30</span>
												</div>
												<div class="clearfix"></div>
												<h5 class="card-title mb-1"><a data-toggle="modal" href="">Tình hình là hoạt động game hiện nay spl làm rất tốt khi biết lắng nghe khách hàng Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.</a></h5>
										</div> 
										<div class="card-footer p-1"> 
											<button type="button" data-toggle="modal" data-target="" class="btn btn-primary btn-sm mx-1 px-2 py-0 float-left" >Chi tiết</button>
											 <button type="button" class="float-right btn btn-outline-success mx-1 px-2 py-0 btn-sm btn-del">Xóa</button> 
											 <button type="button" class="float-right btn btn-outline-success mx-1 px-2 py-0 btn-sm btn-edit">Sửa</button> 
										</div> 
									</div> 
								</div> -->
								
							</div>
							
							<!-- form phần đăng bài -->
							<div id="dangbai" class="col-12">
								<form id="form-dang-bai" method="post" enctype="multiple/form-data">
									<input type="hidden" name="dangbai_token" value="{{ csrf_token() }}">
								  	<div class="form-row">
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label"><strong>Server</strong></label>
								      		<select class="form-control" name="server">
								      			@if (isset($server_game))
								      			@foreach($server_game as $sv)
									      			<option value="{{ $sv->id }}">{{ $sv->servername }}</option>
									      			@endforeach
								      			@endif
								      		</select>
								    	</div>
								  	</div>
								  	<div class="form-group">
								    	<label class="col-form-label"><strong>Tiêu đề</strong></label>
								    	<input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề" required>
								    	<small class="form-text text-muted">Hãy nhập tiêu đề ngắn gọn súc tích, phần đầy đủ nội dung sẽ được trình bày ở bên dưới.</small>
								  	</div>
								  	<div class="form-group">
								    	<label class="col-form-label"><strong>Nội dung chi tiết</strong></label>
								    	<textarea id="noidungchitiet" class="form-control" name="noidung" required></textarea>
								    	<script type="text/javascript">CKEDITOR.replace('noidungchitiet');</script>
								  	</div>
								  	<div class="form-inline">
									  	<button id="btnUploadFile" type="button" class="btn btn-primary" onclick="selectFile()">Chọn hình
										  	<input style="display:none" type="file" id="uploadfile" name="file" accept="image/*" onchange="selectImage(this.files)" multiple>
									  	</button>
									  	<input id="showmessage" type="text" name="" class="form-control ml-1 col-4" readonly>
								  	</div>
								  	<div id="filelist" class="form-inline mt-3">
								  		{{-- Show file trước khi upload --}}
								  	</div>
								  	<div class="form-row">
								    	<div class="form-group col-md-4">
								      		<label for="inputCity" class="col-form-label"><strong>Giá bán</strong></label><br>
								      		<label class="form-check-label">
									      		<input type="radio" name="price-type" value="vang" class="form-check-input" checked> Vàng
								      		</label>
								      		<small class="text-muted"> ( Không nên viết <s>3k,3kv</s>. Hãy viết <u>3000</u>,<u> 5000</u> )</small>
								      		{{-- <input type="number" name="vang" class="form-control" max="100000" oninvalid> --}}
								    	</div>
									    <div class="form-group col-md-4">
									      	<label for="inputCity" class="col-form-label fade">Giá bán</label><br>
									      	<label  class="form-check-label">
									      		<input type="radio" name="price-type" value="vnd" class="form-check-input"> VNĐ
									      	</label>
									      	<small class="text-muted"> ( Không nên viết <s>300k,500k</s>. Hãy viết <u>300000</u>,<u> 500000</u> )</small>
									      	{{-- <input type="number" name="tien" class="form-control"> --}}
									    </div>
									    <div class="form-group col-md-1">
									    	<label for="inputCity" class="col-form-label fade">Giá bán</label><br>
									      	<label class="form-check-label">
									      		<input type="radio" name="price-type" value="xu" class="form-check-input"> Xu
									      	</label>
									    </div>
									    <div class="form-group col-md-3">
									      	<label class="col-form-label fade">Khác </label><br>
									      	<label class="form-check-label">
									      		<input type="radio" name="price-type" value="khac" class="form-check-input"> Khác
									      		<select class="form-control-sm" name="select-price">
									      			<option value="Giao lưu">Giao lưu</option>
									      			<option value="Thỏa thuận">Thỏa thuận</option>
									      		</select>
									      	</label>
									      	{{-- <small class="text-muted"> ( Nếu bán nhiều item trong một lần, hãy check vào đây )</small> --}}
									      	{{-- <input type="checkbox" name="khac" class="form-control text-muted" value="Tôi đã đặt giá trong nội dung bài viết"readonly> --}}
									    </div>
									    <div class="form-inline price-form">
									    	<input type="number" name="price" class="form-control" placeholder="Nhập số lượng" min="1" max="99999999" minlength="1" maxlength="8" price-type="vang"> <i class="icon-vang"></i>
									    </div>
									  	
								  	</div>
								  	{{-- <div class="form-group">
								      	<label for="inputState" class="col-form-label"><strong>Fix giá</strong></label>
							    		<div class="form-check">
								      		<label class="form-check-label mr-2">
								        		<input class="form-check-input" type="radio" name="fix"> Fix mạnh
								      		</label>
								      		<label class="form-check-label mr-2">
								        		<input class="form-check-input" type="radio" name="fix"> Có thể thương lượng
								      		</label>
									      	<label class="form-check-label mr-2">
									        	<input class="form-check-input" type="radio" name="fix"> KMC (<small class="text-muted">Không mặc cả</small>)
									      	</label>
								   		</div>
								  	</div> --}}
							      	<label class="col-form-label"><strong>Thông tin liên hệ</strong> <small class="text-muted">( hãy cung cấp thông tin liên hệ chính xác để người mua có thể liên lạc với bạn.)</small></label>
								  	<div class="form-row">
								    	<div class="form-group col-md-4 mb-1">
								      		<label class="col-form-label">SĐT</label>
								      		<input type="tel" name="sdt" minlength="10" maxlength="11" title="Three letter country code" class="form-control">
							
								    	</div>
								    	<div class="form-group col-md-4 mb-1">
								      		<label class="col-form-label">Facebook</label>
								      		<input type="text" name="fb" placeholder="Đường dẫn hoặc tên FB" class="form-control" autocomplete="on">
								    	</div>
								    	<div class="text-muted ml-1 mb-3">
								      		<small>* Nếu bạn đã thiết lập ở bảng thông tin cá nhân thì không cần điền hai thông tin này</small>
								    	</div>
								  	</div>
								  	<div class="form-group">
								    	<label class="custom-control custom-checkbox">
									  		<input type="checkbox" name="check-xacnhan" class="custom-control-input" required>
									  		<span class="custom-control-indicator"></span>
									  		<span class="custom-control-description">Mọi thông tin đã chính xác.</span>
										</label>
										<br>
										<div class="form-inline">
									  		<button type="submit" class="btn btn-primary my-2" user-id="{{Auth::user()->id}}">Đăng bài</button>
									  		<div id="submit-loading"></div>
										</div>
								  	</div>
								</form>
								<div id="show-errors-form-data" class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title">* Lỗi</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											{{-- show errors --}}
										</div>
									</div>
								</div>
							</div>
							<!--End form phần đăng bài -->

							<!-- phần sửa bài -->
							<div id="suabai" class="col-12" style="display:none">
								<form>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								  	<div class="form-row">
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label"><strong>Loại hình</strong></label>
								      		<select class="form-control">
								      			<option>Account</option>
								      			<option selected>Vật phẩm</option>
								      		</select>
								    	</div>
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label"><strong>Server</strong></label>
								      		<select class="form-control">
								      			<option>Thanh long</option>
								      			<option selected>Hắc hổ</option>
								      		</select>
								    	</div>
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label"><strong>Thời hạn</strong></label>
								      		<select class="form-control">
								      			<option>10 giờ</option>
								      			<option>1 ngày</option>
								      			<option>3 ngày</option>
								      			<option selected>1 tuần</option>
								      			<option>3 tuần</option>
								      		</select>
								      		<small class="form-text text-muted pl-1">Sau khi hết hạn, bài viết sẽ không còn được hiển thị.</small>
								    	</div>
								  	</div>
								  	<div class="form-group">
								    	<label class="col-form-label"><strong>Tiêu đề</strong></label>
								    	<input type="text" class="form-control" placeholder="Nhập tiêu đề" value="Bán acc đây ae">
								    	<small class="form-text text-muted">Hãy nhập tiêu đề ngắn gọn súc tích, phần đầy đủ nội dung sẽ được trình bày ở bên dưới.</small>
								  	</div>
								  	<div class="form-group">
								    	<label class="col-form-label"><strong>Nội dung chi tiết</strong></label>
								    	<textarea id="trungabcd" class="form-control" placeholder="Nhập nội dung">Ra đi acc 500k không nuối tiêc đây</textarea>
								    	<script type="text/javascript">CKEDITOR.replace('trungabcd');</script>
								  	</div>
								  	<div class="form-row">
								    	<div class="form-group col-md-4">
								      		<label for="inputCity" class="col-form-label"><strong>Giá bán</strong></label><br>
								      		<label class="form-check-label">
									      		<input type="radio" name="gia" class="form-check-input"> Vàng
								      		</label>
								      		<small class="text-muted"> ( Không nên viết <s>3k,3kv</s>. Hãy viết <u>3000</u>,<u> 5000</u> )</small>
								      		<input type="number" class="form-control" max="100000" oninvalid>
								    	</div>
									    <div class="form-group col-md-4">
									      	<label for="inputCity" class="col-form-label fade">Giá bán</label><br>
									      	<label  class="form-check-label">
									      		<input type="radio" name="gia" class="form-check-input" checked"> VNĐ
									      	</label>
									      	<small class="text-muted"> ( Không nên viết <s>300k,500k</s>. Hãy viết <u>300000</u>,<u> 500000</u> )</small>
									      	<input type="number" class="form-control" value="500000">
									    </div>
									    <div class="form-group col-md-4">
									      	<label class="col-form-label fade">Khác </label><br>
									      	<label class="form-check-label">
									      		<input type="radio" name="gia" class="form-check-input"> Khác
									      	</label>
									      	<small class="text-muted"> ( Nếu bán nhiều item trong một lần, hãy check vào đây )</small>
									      	<input type="text" class="form-control text-muted" value="Tôi đã đặt giá trong nội dung bài viết" readonly>
									    </div>
								  	</div>
								  	<div class="form-group">
								      	<label for="inputState" class="col-form-label"><strong>Fix giá</strong></label>
							    		<div class="form-check">
								      		<label class="form-check-label mr-2">
								        		<input class="form-check-input" type="radio" name="trung"> Fix mạnh
								      		</label>
								      		<label class="form-check-label mr-2">
								        		<input class="form-check-input" type="radio" name="trung" checked> Có thể thương lượng
								      		</label>
									      	<label class="form-check-label mr-2">
									        	<input class="form-check-input" type="radio" name="trung"> KMC (<small class="text-muted">Không mặc cả</small>)
									      	</label>
								   		</div>
								  	</div>
							      	<label class="col-form-label"><strong>Thông tin liên hệ</strong> <small class="text-muted">( hãy cung cấp thông tin liên hệ chính xác để người mua có thể liên lạc với bạn.)</small></label>
								  	<div class="form-row">
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label">SĐT</label>
								      		<input type="text" name="" minlength="10" maxlength="11" title="Three letter country code" class="form-control" value="0167828843">

								    	</div>
								    	<div class="form-group col-md-4">
								      		<label class="col-form-label">Facebook</label>
								      		<input type="text" name="" placeholder="Đường dẫn đến FB" class="form-control" autocomplete="on" value="facebook/htt7321">
								    	</div>
								  	</div>
								  	<div class="form-group">
								    	<label class="custom-control custom-checkbox">
									  		<input type="checkbox" class="custom-control-input" required>
									  		<span class="custom-control-indicator"></span>
									  		<span class="custom-control-description">Mọi thông tin đã chính xác.</span>
										</label>
										<br>
								  		<button type="submit" class="btn btn-primary my-2">Lưu</button>
								  		<button type="button" class="btn btn-primary my-2">Thoát</button>
								  	</div>
								</form>
							</div>
							<!-- End - phần sửa bài -->
						</div>

						<div class="card-footer p-1"></div>
					</div> <!-- End card -->
				</div>
				<!-- End - Quản lý bài viết thành viên -->
				<!-- nội dung chi tiết -->
				<div id="chi-tiet-san-pham">
					{{-- Show chi tiết sản phẩm --}}
				</div>
				<!-- End - nội dung chi tiết -->
				@endif
				<!-- Begin - Tao layer làm chức năng điều khiển -->
				<div class="row">
				    <div id="nhom-chuc-nang" class="col col-4 align-self-start ml-1">
						@if (Auth::check())
							<div class="row">
								<!--Begin- Phần info cá nhân -->
								<div id="info-content" class="card card-control col-12" data-hidden="all">
									<div class="card-header">
										<nav class="navbar justify-content-between p-0">
											<label class="m-0"><strong>Thông tin cá nhân</strong></label>
										    <button class="btn btn-outline-secondary btn-close-control py-1 px-2 my-sm-0" type="button">&times;</button>
										</nav>
									</div>
									<div class="card-body" >

										<div id="avatar" class="mx-auto" style="background:url('image/kiemhiep.jpg') center no-repeat;">
										</div>
										<div id="show-info">
											<div id="edit-name" class="form-group row">
												<label class="col-4 p-0">Nickname:</label>
												@if( empty(Auth::user()->nickname) )
													<label class="col-8 p-0" style="color: #868e96;">chưa đặt nickname</label>
												@else
													<label class="col-8 p-0">{{ Auth::user()->nickname }}</label>
												@endif
											</div>
											<div id="edit-birth" class="form-group row">
												<label class="col-4 p-0">Điện thoại:</label>
												@if( empty(Auth::user()->sdt) )
													<label class="col-8 p-0" style="color: #868e96;">chưa đặt SĐT</label>
												@else
													<label class="col-8 p-0">{{ Auth::user()->sdt }}</label>
												@endif
											</div>
											<div id="edit-birth" class="form-group row">
												<label class="col-4 p-0">Facebook:</label>
												@if( empty(Auth::user()->fb) )
													<label class="col-8 p-0" style="color: #868e96;">chưa đặt FB</label>
												@else
													<label class="col-8 p-0">{{ Auth::user()->fb }}</label>
												@endif
											</div>
											<div id="edit-exp" class="form-group row">
												<label class="col-4 p-0">Exp:</label>
												<label class="col-8 p-0">{{ Auth::user()->exp }}</label>
											</div>
											
											<button class="col-2 p-0 btn btn-sm btn-outline-info float-right">Sửa</button>
											
										</div>
										<div id="edit-info" class="sr-only">
										<form>
											<div id="add-avatar" class="btn btn-sm btn-outline-info d-block my-2">
												<input type="file" class="mx-auto form-file">
											</div>
											<div id="save-name" class="form-group row">
												<label class="col-4 p-0 col-form-label">Nickname:</label>
												<input class="col-6 p-0 form-control" required value="{{ Auth::user()->nickname }}"></input>
											</div>
											<div id="save-birth" class="form-group row">
												<label class="col-4 p-0 col-form-label">Điện thoại:</label>
												<input class="col-6 p-0 form-control" value="{{ Auth::user()->sdt }}" required></input>
											</div>
											<div id="save-birth" class="form-group row">
												<label class="col-4 p-0 col-form-label">Facebook:</label>
												<input class="col-6 p-0 form-control " value="{{ Auth::user()->fb }}" required></input>
												<label class="text-muted"> <small>* Số điện thoại và Facebook sẽ được sử dụng để liên hệ, vì vậy hãy cung cấp thông tin chính xác.</small></label>
											</div>
											<button id="remove" type="button" class="col-2 p-0 btn btn-sm btn-outline-secondary float-right">Hủy</button>
											<button id="save" type="submit" class="col-2 p-0 btn btn-sm btn-outline-info float-right mx-1">Lưu</button>
										</form>
											
										</div>
									</div>
								</div>
								<!--End- Phần info cá nhân -->
								
								<!-- Begin - Phần giới thiệu page -->
								<div id="intro-content" class="card card-control col-12" data-hidden="all">
									<div class="card-header">
										<nav class="navbar justify-content-between p-0">
										<!-- <div class="text-center" style="width:100%"> -->
											<label class="m-0"><strong>Giới thiệu</strong></label>
											
										<!-- </div> -->
										    <button id="" class="btn btn-outline-secondary btn-close-control py-1 px-2 my-sm-0 " type="button">&times;</button>
										</nav>
									</div>
									<div id="scroll" class="card-body">
										<p class="title" style="color: #db5800"><strong>{{ isset($introduce->tieude) ? $introduce->tieude : "Khong co tieu de" }}</strong></p>
										<div class="intro-noidung">
											{!! isset($introduce->noidung) ? $introduce->noidung : "Khong co noi dung" !!}
										</div>
									</div>
								</div>
								<!-- End - Phần giới thiệu page -->

							</div> 
					    @endif
				    </div>

				    <div class="col align-self-center">
				    	{{-- Thông báo chức năng đang cập nhật --}}
				    	<div class="card dang-cap-nhat text-center" style="width: 18rem; margin:0 auto; border-color: gold;display: none; border-radius: 15px;overflow: hidden;position:absolute;">
					    	<div class="card-header">Chức năng này đang được cập nhật</div>	
						</div>
						<!-- Center -->
						
						<div class="row">
							<!-- Bảng giao tiếp với npc -->
							<div class="card control-answer mx-4">
								<div class="card-title"><strong>Võ Lâm Chí Tôn</strong></div>
								<div class="card-body">
									<p style="color:#db5800;">Đại hiệp, ta có thể giúp gì?</p>
									<p>
										<a href="{{ route('sontrang' )}}">Ta muốn đến <em>Account Sơn Trang</em></a> <br>
										{{-- <a href="item.html">Ta muốn đến <em>Doanh Trại Item</em></a> <br> --}}
										<a href="{{ route('tradaoquan') }}">Ta muốn đến <em>Trà Đạo Quán</em></a> <br>
										<p class="divider my-1"></p>
										<a href=""><small>Ta muốn gửi lời <em>khiêu chiến</em> đến các anh hùng trong thiên hạ.</small></a>
									</p>
									<p><a href="javascript:void(0)" id="close-control-answer"><small><strong>Không có gì!</strong></small></a></p>
								</div>
							</div>
							<!-- Kết thúc bảng giao tiếp -->

					    	<div class="col align-self-start"></div>
							<div id="control" class="col align-self-center p-0" data-toggle="tooltip" title="Võ Lâm Chí Tôn">
							<!-- Tạo layer làm chức năng điều khiển -->
							<img src="image/hand-click.gif" style="width: 100px; margin: 23px 0 0 23px;display:none" class="hand-click">
							</div>
							<div class="col align-self-end"></div>
						</div>

				    </div>
				    <div class="col align-self-end"></div>
				</div>

				<!-- Nội dung phần thông báo -->
				<div class="thongbao-background">		
					<!-- background thông báo -->
				</div>
				<div id="scroll" class="thongbao-show">
					<div style="width:230px;height:40px;background:url('image/jx2-lg-nobg.gif') no-repeat;"></div>
					{{-- <a href="">Bạn có tin nhắn từ ban quản trị.</a> --}}
					@if(!Auth::check())
						<div class="" style="color: red">
							<label><em>* Hãy <a href="{{ route('dangnhap') }}" style="text-decoration: none;"><kbd>đăng nhập</kbd></a> để có thể đăng bài và sử dụng các chức năng dành cho thành viên!</em></label>
						</div>
					@endif
				</div>
				{{-- <div class="warning mx-4" style="position: absolute;bottom:0;color: red">
					<label><em>* Hãy <strong>đăng nhập</strong> để có thể đăng bài và sử dụng các chức năng dành cho thành viên!</em></label>
				</div> --}}
				<!-- End - phần thông báo -->
			</div> 

			<!-- End body -->
			<!-- footer -->
			{{-- Đăng nhập để sử dụng các chức năng dành cho thành viên --}}
			@if(Auth::check())
				<div class="card-footer p-0" data-check=0>
					<ul class="nav justify-content-center">
						<div  id="introduce" class="sub-control" title="Giới thiệu">
							{{-- Icon giới thiệu về page --}}
						</div>
						<div id="nhiemvu" class="sub-control dangcapnhat">
							{{-- Nhiệm vụ --}}
						</div>
						<div id="info" class="sub-control" title="Cá nhân">
							{{-- Icon thông tin cá nhân --}}
						</div>
						<div id="book" class="sub-control dangcapnhat">
							{{-- Nhiệm vụ --}}
						</div>
						<div id="baiviet" class="sub-control" title="Bài đăng" onclick="loadSanPham({{Auth::user()->id}})">
							{{-- Bài đăng --}}
						</div>
					</ul>
				</div> 
			@endif
			<!-- End footer -->
		</div> <!-- End card -->
	</div>	<!-- End container -->
	



	<script src="js/jquery.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->
	<script src="js/popper/popper.min.js"></script>
	<script src="js/bootstrap-js/bootstrap.min.js"></script>
	<script src="js/my-style.js" async></script>
</body>
</html>