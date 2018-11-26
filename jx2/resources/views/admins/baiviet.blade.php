@extends('layouts.admin.master')

@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Quản lý bài viết</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Danh sách bài viết</li>
	</ol>
</nav>
<div class="table-responsive-sm">
	<div class="float-left">Có <strong>{{ isset($baiviet) ? $baiviet->count() : '0' }}</strong> bài viết</div>
	<button data-target="#modalThemSanPham" data-toggle="modal" class="btn btn-primary btn-outline-primary mb-1 float-md-right"><i class="fas fa-plus mr-1"></i>Bài viết mới</button>
	<div class="modal" id="modalThemSanPham" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Bài viết mới</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label>Tiêu đề</label>
							<input type="text" name="txtTieuDe" placeholder="Nhập tiêu đề ..." class="form-control">
						</div>
						<div class="form-group">
							<label class="">Nội dung</label>
							<textarea class="form-control" rows="10" id="noiDungBaiViet"></textarea>
							<script>
				                CKEDITOR.replace( 'noiDungBaiViet' );
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
		<caption>Danh sách bài viết</caption>
		<thead class="thead-light">
			<tr>
				<th class="scope pr-0">
					<span>
						STT
					</span>
					<div>
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
					Bình luận
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope text-center">#</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($baiviet) || !empty($baiviet))
			<?php $i = 0 ?>
				@foreach($baiviet as $bv)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $bv->user->username }}</td>
						<td>{{ $bv->tieude }}</td>
						<td>{{ $bv->likeView->likes }}</td>
						<td>{{ $bv->likeView->views }}</td>
						<td>{{ count($bv->comment) }}</td>
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
					<td colspan="7">Chưa có bài viết</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
@endsection