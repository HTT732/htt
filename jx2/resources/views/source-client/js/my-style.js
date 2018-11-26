$(document).ready(function(){
	var widthWindow = screen.availWidth;
	var heightWindow = screen.availHeight;
	var heightBrowser = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

	
	// 0.9 ở đây có nghĩa là lấy chiều cao 90%
	var height_main = Math.round(heightWindow * 0.9);
	if (heightWindow >= 700 && heightWindow < 800){						
		$(".my-card").height(height_main);
		//Giới hạn chiều cao cho cửa sổ chức năng
		$(".card-control .card-body").css("max-height", (height_main - 120) + "px");
		$(".baiviet .card-body").css("max-height", (height_main - 120) + "px");

		//Tinh khoảng cách dư để cho cách top
		var space_height = heightBrowser - height_main;
		if (space_height >= 10){
			$(".my-card").css("margin-top", Math.round(space_height / 4) + "px"); // màn hình chính cách top 1/3
		}
	}
	else if (heightWindow < 700){
		$(".my-card").height(650);
		//Giới hạn chiều cao cho cửa sổ chức năng
		$(".card-control .card-body").css("max-height", "540px");
		$(".baiviet .card-body").css("max-height", "530px");
	}
	else {
		$(".my-card").height("768px");
		
		//Giới hạn chiều cao cho cửa sổ chức năng
		$(".card-control .card-body").css("max-height", "648px");
		$(".baiviet .card-body").css("max-height", "648px");

		//Tinh khoảng cách dư để cho cách top
		var space_height = heightBrowser - height_main;
		if (space_height >= 10){
			$(".my-card").css("margin-top", Math.round(space_height / 4) + "px"); // màn hình chính cách top 1/4
		}
	}

	//Ẩn đi chức năng khi ng dùng chưa đăng nhập
	if ($(".card-footer").attr("data-check") == "0"){
		$(".card-footer").css("display", "none");
		$(".notification").hide();
	}
	else{
		$(".warning").hide();
	}
	$('[data-toggle="tooltip"]').tooltip();

	// show phần thông tin cá nhân và ẩn các thành phần control khác

	//show phần giao tiếp npc
	$("#control").click(function(){
		$(".control-answer").fadeIn("fast");
	});

	//hide phần giao tiếp npc
	$("#close-control-answer").click(function(){
		$(".control-answer").fadeOut("fast");
	});

	$("#info").click(function(){
		$("[data-hidden='all']").hide();
		$("#info-content").toggle();
	});

	// show phần giới thiệu và ẩn các thành phần control khác
	$("#introduce").click(function(){
		$("[data-hidden='all']").hide();
		$("#intro-content").toggle();
	});

	$("#baiviet").click(function(){
		$("[data-hidden='all']").css("display", "none");
		$(".baiviet").toggle();
	})
	//hide phần thông tin các nhân hoặc phần giới thiệu khi click vào nút close
	$(".btn-close-control").click(function(){
		$("[data-hidden='all']").hide();
	})

	// Nhấn esc để tắt cửa sổ thay cho nhấn x
	$(document).keyup(function(e){
		if (e.keyCode == 27){
			$("[data-hidden='all']").hide();
		}
	})
	$(document).bind("contextmenu",function(e){
		//Nếu muốn cấm click chuột phải thì return false
	    // return false;
	});

	// Sửa thông tin cá nhân
	$("#show-info button").click(function(){
		$("#show-info").addClass('sr-only');
		$("#edit-info").removeClass('sr-only');
	})
	// Thực hiện hoàn lại giao diện khi ng dùng chọn hủy
	$("#remove").click(function(){
		$("#edit-info").addClass('sr-only');
		$("#show-info").removeClass('sr-only');
	})

	$("#control-baiviet").click(function(){
		$(".noidungbaiviet").fadeIn("fast");
		$("#dangbai").hide();
		$("#suabai").hide();
	})
	$("#control-dangbai").click(function(){
		$("#dangbai").fadeIn("fast");
		$(".noidungbaiviet").hide();
		$("#suabai").hide();
	})

	$(".btn-edit").click(function(){
		$("#suabai").show();
		$(".noidungbaiviet").hide();
		$("#dangbai").hide();
	})

});