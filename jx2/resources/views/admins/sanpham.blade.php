@extends('layouts.admin.master')

@section('content')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="#">Quản lý sản phẩm</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
		</ol>
	</nav>
	<div class="table-responsive-sm">
		<div class="float-left">Có <strong>{{ count($sanpham) }}</strong> sản phẩm</div>
		<button data-target="#modalThemSanPham" data-toggle="modal" class="btn btn-primary btn-outline-primary mb-1 float-md-right"><i class="fas fa-plus mr-1"></i>Thêm sản phẩm</button>
		<div class="modal" id="modalThemSanPham" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Thêm sản phẩm</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label>Server</label>
								<select class="form-control ">
									<option selected>Lựa chọn</option>
									@foreach($sanpham as $sp)
										<option>{{ $sp->server }}</option>
									@endforeach
									
								</select>
							</div>
							<div class="form-group">
								<label>Tiêu đề</label>
								<input type="text" name="txtTieuDe" class="form-control" placeholder="Nhập tiêu đề ...">
							</div>
							<div class="form-group">
								<label class="">Nội dung</label>
								<textarea class="form-control" rows="10" id="noiDungSanPham"></textarea>
								<script>
									CKEDITOR.replace('noiDungSanPham');
								</script>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
						<button type="button" class="btn btn-primary">Thêm</button>
						
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<table class="table table-striped table-bordered">
			<caption>Danh sách sản phẩm</caption>
			<thead class="thead-light">
				<tr>
					<th class="scope pr-0">
						<span>
							STT
						</span>
						<div class="float-left">
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Đăng bởi
						<div>
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Tiêu đề
						<div>
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Hình
						<div>
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Lượt thích
						<div>
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Lượt xem
						<div>
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope">
						Thời hạn
						<div class="float-left">
							<i class="fas fa-arrow-circle-up"></i>
							<i class="fas fa-arrow-circle-down"></i>
						</div>
					</th>
					<th class="scope text-center">#</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@if( isset($sanpham) || !empty($sanpham))
					@foreach($sanpham as $sp)
					
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $sp->user->username }}</td>
							<td>{{ $sp->tieude }}</td>
							<td>
								<img src="https://via.placeholder.com/100x100">
							</td>
							<td>{{ $sp->likeView->likes }}</td>
							<td>{{ $sp->likeView->views }}</td>
							<td>10 ngày</td>
							<td>
								<button class="btn btn-light btn-edit"  title="Sửa">
									<i class="fas fa-edit"></i>
								</button>
								<button class="btn btn-light btn-del" title="Xóa">
									<i class="fas fa-trash-alt" ></i>
								</button>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="9">
							Không có sản phẩm
						</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
@endsection