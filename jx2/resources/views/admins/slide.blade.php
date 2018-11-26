@extends('layouts.admin.master')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Quản lý bài viết</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Danh sách bài viết</li>
	</ol>
</nav>
<div class="table-responsive-sm">
	<button data-target="#modalThemSlide" data-toggle="modal" class="btn btn-primary btn-outline-primary mb-1 float-md-right"><i class="fas fa-plus mr-1"></i>Thêm slide</button>
	<div class="modal" id="modalThemSlide" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Thêm sile</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label>Tiêu đề</label>
							<input type="text" name="txtTieuDe" placeholder="Nhập tiêu đề..." class="form-control">
						</div>
						<div class="form-group">
							<label>URL</label>
							<input type="text" name="txtUrl" placeholder="Nhập url..." class="form-control">
						</div>
						<div class="custom-file">
							<input type="file" name="upFile" class="custom-file-input" id="uploadFile" required>
							<label class="custom-file-label" for="uploadFile">Chọn File...</label>
							<div class="checkChooseFile text-success fade">
								<small>
									Đã chọn 1 file
								</small>
							</div>
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
		<caption>Danh sách slide</caption>
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
					Hình
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					URL
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope text-center">#</th>
			</tr>
		</thead>
		<tbody>
			@if( isset($slide) )
			<?php $i = 0 ?>
				@foreach($slide as $sl)
					<tr>
						<td>{{ ++$i }}</td>
						<td>
							<img src="{{ !empty($sl->hinh) ? $sl->hinh : $sl->url }}" class="img-fluid">
						</td>
						<td>{{ !empty($sl->url) ? $sl->url : "NULL" }}</td>
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
					<td colspan="4">Chưa có slide</td>
				</tr>
			@endif	
		</tbody>
	</table>
</div>
@endsection