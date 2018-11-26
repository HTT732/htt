@extends('layouts.admin.master')
@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Quản lý thành viên</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Danh sách thành viên</li>
	</ol>
</nav>
<div class="table-responsive-sm">
	<div class="btn-sm read-only float-left">Có <strong>{{ isset($user) ? $user->count() : '0' }}</strong> thành viên</div>
	<button data-target="#modalThemThanhVien" data-toggle="modal" class="btn btn-primary btn-outline-primary mb-1 float-md-right"><i class="fas fa-plus mr-1"></i>Thêm thành viên</button>
	<div class="modal" id="modalThemThanhVien" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Thêm thành viên</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="row">
							
						<div class="form-group col col-6 pl-0">
							<label class="mr-1">Username</label>
							<input type="text" name="txtUsername" class="form-control" placeholder="Nhập Username">
						</div>
						<div class="form-group col col-6">
							<label class="mr-1">Password</label>
							<input type="text" name="txtPassword" class="form-control" placeholder="Nhập Password">
						</div>
						</div>
						<div class="form-group">
							<label>Level</label>
							<select class="form-control ">
								<option>Thành viên</option>
								<option>Admin</option>
								<option>Super Admin</option>
							</select>
						</div>
						<div class="form-group">
							<label>Số điện thoại</label>
							<input type="number" name="txtSDT" class="form-control">
						</div>
						<div class="form-group">
							<label>EXP</label>
							<input type="number" name="txtEXP" class="form-control" step="10">
						</div>
						<div class="form-group">
							<label>Facebook</label>
							<input type="text" name="txtFB" class="form-control" placeholder="Nhập tiêu đề ...">
						</div>
						<div class="form-group">
							<label class="">Chú thích</label>
							<textarea class="form-control" rows="5" id="noiDungThemThanhVien"></textarea>
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
		<caption>Danh sách thành viên</caption>
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
					Tài khoản
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Nickname
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Facebook
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					SĐT
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					EXP
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope">
					Level
					<div>
						<i class="fas fa-arrow-circle-up"></i>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</th>
				<th class="scope text-center">#</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 0 ?>
			@if( isset($user))
				@foreach($user as $value)
					<?php $i++ ?>
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $value->username }}</td>
						<td>{{ $value->nickname }}</td>
						<td><a href="{{ $value->fb }}">{{ $value->fb }}</a></td>
						<td>
							{{ $value->sdt }}
						</td>
						<td>{{ $value->exp }}</td>
						<td>{{ $value->level }}</td>
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
					<td colspan="7">Chưa có thành viên</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
@endsection