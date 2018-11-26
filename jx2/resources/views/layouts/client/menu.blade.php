{{-- menu --}}
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <a class="navbar-brand" href="{{ route('trangchu') }}" data-toggle="tooltip" title="Diện kiến Võ Lâm Chí Tôn"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="menu">
	    <ul class="navbar-nav mr-auto">
	    <a href="{{ route('sontrang') }}"></a>
	    <a href="{{ route('tradaoquan') }}"></a>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm..." aria-label="Search">
	      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
</nav>
{{-- end menu --}}


{{-- So luong & sap sep --}}
<div class="top d-flex justify-content-between">
	<div class="left">Account - có <strong>{{ $countSP }}</strong> bài.</div>
	<div class="right">
		<label class="mr-1">Sắp xếp theo: </label> 
		<select class="form-control-sm">
			<option> Giá: từ thấp đến cao</option>
			<option> Giá: từ cao đến thấp</option>
			<option> Ngày: mới đến cũ</option>
			<option> Lượt xem nhiều</option>
			<option> Lượt thích nhiều</option>
		</select>
	</div>
</div>
<div class="productStatus">
	{{-- Có <span class="badge badge-danger rounded-circle">6</span> sản phẩm vừa được đăng. <a href="{{route('sontrang')}}"><kbd>Cập nhật</kbd></a> --}}
	Có <span class="badge badge-danger rounded-circle">6</span> sản phẩm vừa được đăng. <kbd onclick="reloadhtt()">Cập nhật</kbd></a>
</div>