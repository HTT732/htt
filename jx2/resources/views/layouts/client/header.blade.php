<div class="header">
	{{-- banner --}}
	<div class="logo">
	</div>

	{{-- slide --}}
	<div class="row m-0 my-4">
		<div id="tin-tuc-noi-bat" class="col col-12 order-md-2 order-lg-1 col-lg-4">
			<div class="card rounded-0 border-0" style="height: 100%">
				<div class="card-header">
					<strong>Tin tức nổi bật</strong>
				</div>
				<div class="card-body">
					<div class="card-text">
						<i class="fas fa-yin-yang mr-1"></i>
						<a href="#">With supporting text below as a natural lead-in to additional content.</a>
					</div>
					<div class="card-text">
						<i class="fas fa-yin-yang mr-1"></i>
						<a href="#">With supporting text below as a natural lead-in to additional content.</a>
					</div>
					<div class="card-text">
						<i class="fas fa-yin-yang mr-1"></i>
						<a href="#">With supporting text below as a natural lead-in to additional content.</a>
					</div>
				</div>
			</div>
		</div>
		@php
			$slider = json_decode($slide);
		@endphp
		<div id="slide" class="col col-12 col-lg-8 order-md-1 order-lg-2">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			  	@for($i = 0; $i < count($slider); $i++)
			  		@if($i == 0)
					    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
					@else
					    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
					@endif
			    @endfor
			  </ol>
			  <div class="carousel-inner">
			    @for($i = 0; $i < count($slider); $i++)
				    <div class="carousel-item {{ ($i == 0) ? "active" : ""}}">
				      <a href="#"><img class="d-block w-100" src="{{ empty($slider[$i]->hinh) ? $slider[$i]->url : "image/slider/".$slider[$i]->hinh }}" alt="First slide"></a>
				    </div>
			    @endfor
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>
</div> <!-- End header -->