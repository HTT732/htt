@extends('layouts.admin.master')

@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Quản lý bình luận</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Danh sách bình luận</li>
	</ol>
</nav>
<div class="table-responsive-sm">
	<div class="btn-sm read-only float-left">Có <strong>{{ isset($comment) ? $comment->count() : '0' }}</strong> bình luận</div>
	<table class="table table-striped table-bordered">
		<caption>Danh sách bình luận</caption>
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
					CMT bởi
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
					Tiêu đề bài viết
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
			@if(isset($comment))
				@foreach($comment as $cmt)
				<?php $i++ ?>
					<tr>
						<td>{{ $i }}</td>
						<td>{{ $cmt->user->username }}</td>
						<td>{{ $cmt->noidung }}</td>
						<td>{{ $cmt->baiViet->tieude }}</td>
						<td>
							<button class="btn btn-light btn-del" title="Xóa">
								<i class="fas fa-trash-alt" ></i>
							</button>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5">Chưa có bình luận</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
@endsection