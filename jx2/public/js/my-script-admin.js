$(document).ready(function(){
	// Xoay mũi tên
	$('.card .card-header div').on('click', function(){
		$('.card .card-header div .fa-caret-right').css('transform', 'rotate(0deg)');
		$('.card .card-header div .fa-caret-right').css('transition', '0.3s all');
		
		if ($(this).attr('aria-expanded') == "false" || $(this).attr('aria-expanded') == null){
			$(this).find('.fa-caret-right').css('transform', 'rotate(90deg)');
			$(this).find('.fa-caret-right').css('transition', '0.6s all');
		}
		else{
			$(this).find('.fa-caret-right').css('transform', 'rotate(0deg)');
			$(this).find('.fa-caret-right').css('transition', '0.3s all');
		}
	});

	// Show menu
	$('#btnMenu').click(function(){
		if (!$('#menu').hasClass('active')){
			$("#menu").animate({left:"0px"});
			$('#menu').addClass('active');
		}
		else{
			$("#menu").animate({left:"-350px"});
			$("#menu").removeClass('active');
		}

	});
	// Ẩn menu khi click ra ngoài thành phần
	$(document).on('click', '#content', function(){
		if (window.innerWidth <= 991){
			if ($('#menu').hasClass('active')){
				$("#menu").animate({left:"-350px"});
				$('#menu').removeClass('active');
			}
		}
	})
})

$(document).ready(function() {   
	if (window.innerWidth > 992){
		$(window).bind('scroll', function(e){
			var top = $(window).scrollTop();
			if (top > 59){
				$("#menu").addClass('fixed-top');
				$("#content").css('margin-left', $('#menu').width());
			} else {
				$("#menu").removeClass('fixed-top');
				$("#content").css('margin-left', 0);
			}
		});
	}
});

// Tương tác phụ
$(document).ready(function() {   
	// Hiển thị thông báo sau khi chọn file
	$('#modalThemSanPham #uploadFile').change(function(){
		$(this).parent().children('.checkChooseFile').removeClass('fade');
	});
});
