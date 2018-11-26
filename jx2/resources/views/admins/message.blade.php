@extends('layouts.admin.master')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Quản lý tin nhắn</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Danh sách tin nhắn</li>
	</ol>
</nav>
<div class="table-responsive-sm">
	<div class="float-left">Có <strong>{{ isset($message) ? count($message) : '0' }}</strong> tin nhắn</div>
	<button data-target="#modalThemTinNhan" data-toggle="modal" class="btn btn-primary btn-outline-primary mb-1 float-md-right"><i class="fas fa-plus mr-1"></i>Thêm tin nhắn</button>
	<div class="modal" id="modalThemTinNhan" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Thêm tin nhắn</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label>Loại tin</label>
							<select class="form-control ">
								@foreach($loaitin as $lt)
									<option>{{ $lt->type }}</option>
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
								CKEDITOR.replace('noiDungSanPham')
							</script>
						</div>
						<div class="form-group">
							<label>Người nhận</label>
							<div class="form-inline">
								@foreach($user as $us)
									<div class="form-group">
										<input type="checkbox" name="cb" id="validCheckbox">
										<label for="validCheckbox" class="mr-5 ml-1">{{ $us->username }}</label>
									</div>
								@endforeach
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
	<table class="table table-striped table-bordered table-inverse">
		<caption>Danh sách tin nhắn</caption>
		<thead class="thead-light">
			<tr >
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
					Loại tin
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
					Nội dung
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Người gửi
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Người nhận
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Thời gian
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope text-center">#</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($message))
			<?php $i = 0 ?>
				@foreach($message as $mess)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ $mess->loaiTin->type }}</td>
						<td>{{ $mess->tieude }}</td>
						<td>
							<p>
								{{ $mess->noidung }}
							</p>
							<div class="btn btn-light form-control">
								<i class="fas fa-angle-double-up"></i>
							</div>
						</td>
						<td>{{ $mess->nguoigui }}</td>
						<td>{{ $mess->nguoinhan }}</td>
						<td>{{ $mess->thoigian }}</td>
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
					<td colspan="8">Không có tin nhắn</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
@endsection