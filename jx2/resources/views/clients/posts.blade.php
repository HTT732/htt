
@extends('layouts.client.master')

@section('detail')
<div class="modal fade" id="sp45" role="dialog" tabindex="-1" data-backdrop="true">
	<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header py-2">
			<div class="modal-title"></div>
			<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			
		</div>
		<div class="modal-body text-center">
			<p>
				-Góc góp ý :
				Tình hình là hoạt động game hiện nay spl làm rất tốt khi biết lắng nghe khách hàng và người chơi :)
				Nhưng kèm theo đó là những giải quyết khắc phục lỗi và tính năng theo một số cá nhân cá thể chưa được thỏa đáng lắm khi mà càng ngày bảng sắc thực sự của game ngày một biếng dạng  :'(
				Vấn đề mình nói trong bài viết này chưa đề cập đến tính năng tk hay là tiềm năng của các phái , hay kill thức bị bug hay buff quá ảo so với bảng chính của nó .
				SPL càng ngày càng dần dần ''lắng nghe khách VIP'' mà quên đi số đông của mn cần gì ở bảng kỉ niệm này ,thay đổi , bẽ cong các thứ một cách độc tôn đến như vậy !! :)
				Duy trì một sever tồn tại rất khó , biết là 1 người treo nhiều acc , hay cầm nhiều acc nó làm đi loãng sv và kém kinh phí để di trì của team :)
				Nhưng thử hỏi hiện nay đa phần m.n chơi ở bảng này họ trở lại là do những tính năng ngày xưa và cày cuốc mà VNG đã từng và bây giờ không còn nữa nên họ mới chơi , cái gọi là kí ức..
				Cương vị là một khách hàng , team SPL làm sao thì mình theo vậy , nhưng mong muốn mình ở đây là liệu khi mà 1 IP chỉ online được 2 nick , đủ chơi ko khi một số người acc chính ko phải là cs và nmk :'( ít ra cũng dc 3 acc !!!
				THa thiết xin một lần được lắng nghe , di trì hoạt động vì số đông chứ đừng vì maketting mà đánh mất đi khách hàng như VNG
				Mong ad duyệt dùm mình , bài viết hơi lũn cũng nhưng chắc m,n hiểu đc mình muốn nói gì :Z
			</p>
			<img src="https://www.facebook.com/photo.php?fbid=192957818253601&set=gm.189134095269235&type=3&eid=ARAvF3MYRBSVf-rH74iYT2s8xltleBdnvWhAhMpvC-0BRLsHgj5YAgCBWKGywiQ6NrePrXy2wkg3iacp">
			<img src="https://www.facebook.com/photo.php?fbid=192957818253601&set=gm.189134095269235&type=3&eid=ARAvF3MYRBSVf-rH74iYT2s8xltleBdnvWhAhMpvC-0BRLsHgj5YAgCBWKGywiQ6NrePrXy2wkg3iacp">
			<img src="https://www.facebook.com/photo.php?fbid=192957818253601&set=gm.189134095269235&type=3&eid=ARAvF3MYRBSVf-rH74iYT2s8xltleBdnvWhAhMpvC-0BRLsHgj5YAgCBWKGywiQ6NrePrXy2wkg3iacp">
		</div>
		<div class="modal-footer">
		<div class="form-inline"> 
			Hãy
			<label  class="like-footer"></label>
			 để cho ta biết đại hiệp đã ghé qua nơi đây.
		</div>
			<button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Đóng</button>
		</div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('content')
	@php
		$sanpham = json_decode($sanpham);
	@endphp
	@foreach($sanpham as $sp)
	<div class="col col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
		<div class="card">

			{!! ($sp->level == 3) ? '<div class="icon-admin"></div>' : ''!!}
			<div class="img d-flex align-items-center justify-content-center">
				<img class="card-img-top" src="{{ $sp->thumb }}" alt="Card image cap" data-target="#sp{{$sp->id}}" data-toggle="modal">
			</div>
			<div class="card-body">
				<div class="body-content">
					<h4 data-toggle="modal" data-target="#sp {{ $sp->id }}">
						{{ $sp->tieude }}
					</h4>
				</div>
				<div class="top-info">
					<div class="view-and-like row m-0 d-flex justify-content-between">
						<span title="Lượt xem"><i class="fas fa-eye"></i>{{ $sp->sum_view }}</span>
						<span title="Thích"><i class="fas fa-thumbs-up"></i>{{ $sp->sum_like }}</span>
						<span title="Thời gian"><i class="fas fa-clock"></i>{{  FormatTime::formatTimeAgo($sp->created_at) }}</span>
					</div>
					<div class="info row m-0">
						<span class="col col-12 text-truncate"><p class="fa">Đăng bởi:</p> <a href="" target="_blank">{{ !empty($sp->nickname) ? $sp->nickname : $sp->username }}</a></span>
						<span class="col col-12"><p class="fa">Giá: </p> {{ ($sp->kieugia == 'vnd') ? number_format($sp->gia) : $sp->gia }} <i class="fa my-{{ ($sp->kieugia == 'vang' || $sp->kieugia == 'xu' || $sp->kieugia == 'vnd') ? $sp->kieugia : ""}}"></i></span>
						<span class="col col-12"><p class="fa">Server: </p> {{ $sp->serverName }}</span>
						<div class="col col-12">
							<button type="button" class="btn btn-outline-danger btn-sm btn-lienhe" data-toggle="collapse" data-target="#lienhe11">Thông tin liên hệ</button>
							<div class="collapse lienhe" id="lienhe00">
								<div class="card card-body" >
									<table>
										<tr>
											<td><i class="fa fa-mobile"></i></td>
											<td>{{ !empty($sp->sdt) ? $sp->sdt : "None"}}</td>
										</tr>
										<tr>
											<td><i class="fa fa-facebook-official"></i></td>
											<td><a href="{{ !empty($sp->fb) ? $sp->fb : "#" }}" target="_blank">Đi đến FB</a></td>
										</tr>
									</table>
								</div>
							</div>
							<button type="button" class="btn btn-outline-primary btn-sm my-2 view-post" data-toggle="modal" data-target="#sp{{ $sp->id }}">Xem bài</button>
						</div>
					</div> 
				</div><!-- End top-info-->
			</div>
		</div>
	</div>
	@endforeach
	<!-- <div class="col col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
		<div class="card">
			<div class="img">
				<img class="card-img-top" src="https://scontent.fdad2-1.fna.fbcdn.net/v/t1.0-9/38999889_441832513004790_579695103195480064_n.jpg?_nc_cat=0&oh=53e2234ec265fdc7555424b39c912ec7&oe=5C0D96BA" alt="Card image cap" data-target="#modal" data-toggle="modal">
	
			</div>
			<div class="card-body" >
				<div class="body-content">
					<h4 data-toggle="modal" data-target="#modal">
						Tình hình là hoạt động game hiện nay spl làm rất tốt khi biết lắng nghe khách hàng và người chơi :) Nhưng kèm theo đó là những giải quyết khắc phục lỗi và tính năng theo một số cá nhân cá thể chưa được thỏa đáng lắm khi mà càng ngày bảng sắc thực sự của game ngày một biếng dạng :'( 
					</h4>
				</div>
				<div class="top-info">
	
					<div class="view-and-like row m-0 d-flex justify-content-between">
						<span title="Lượt xem"><i class="fas fa-eye"></i>2000</span>
						<span title="Thích"><i class="fas fa-thumbs-up"></i>2000</span>
						<span title="Thích"><i class="fas fa-clock"></i>3 tuần trước</span>
					</div>
					<div class="info row m-0">
						<span class="col col-12 text-truncate"><p class="fa">Đăng bởi: </p><a href="" target="_blank">Tiểu Tử Vô Tình</a></span>
						<span class="col col-12"><p class="fa">Giá:</p>999999 <i class="fa my-gold"></i></span>
						<span class="col col-12"><p class="fa">Server:</p>Thanh Long</span>
						{{-- <span class="col col-12"><p class="fa">Ngày đăng:</p>09-09-2017</span> --}}
						{{-- <span class="col col-12"><p class="fa">Hết hạn:</p>20-09-2017</span> --}}
						<div class="col col-12">
							<button type="button" class="btn btn-outline-danger btn-sm btn-lienhe" data-toggle="collapse" data-target="#lienhe11">Thông tin liên hệ</button>
							<div class="collapse lienhe" id="lienhe00">
								<div class="card card-body" >
									<table>
										<tr>
											<td><i class="fa fa-mobile"></i></td>
											<td>01678288643</td>
										</tr>
										<tr>
											<td><i class="fa fa-facebook-official"></i></td>
											<td><a href="https://www.facebook.com/htt732" target="_blank">Đi đến FB</a></td>
										</tr>
									</table>
								</div>
							</div>
							<button type="button" class="btn btn-outline-primary btn-sm my-2 view-post" data-toggle="modal" data-target="#modal">Xem bài</button>
						</div>
					</div> 
				</div>End top-info
			</div>
		</div>
	</div> -->
@endsection