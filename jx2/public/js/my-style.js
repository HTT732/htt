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

	$("#info, .my-card .btn-info-user").click(function(){
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
	});

	// Nhấn esc để tắt cửa sổ thay cho nhấn x
	$(document).keyup(function(e){
		if (e.keyCode == 27){
			$("[data-hidden='all']").hide();
		}
	});
	$(document).bind("contextmenu",function(e){
		//Nếu muốn cấm click chuột phải thì return false
	    // return false;
	});

	// Sửa thông tin cá nhân
	$("#show-info button").click(function(){
		$("#show-info").addClass('sr-only');
		$("#edit-info").removeClass('sr-only');
	});
	// Thực hiện hoàn lại giao diện khi ng dùng chọn hủy
	$("#remove").click(function(){
		$("#edit-info").addClass('sr-only');
		$("#show-info").removeClass('sr-only');
	});

	$("#control-baiviet").click(function(){
		$(".noidungbaiviet").fadeIn("fast");
		$("#dangbai").hide();
		$("#suabai").hide();
	});
	$("#control-dangbai").click(function(){
		$("#dangbai").fadeIn("fast");
		$(".noidungbaiviet").hide();
		$("#suabai").hide();
	});

	$(".btn-edit").click(function(){
		$("#suabai").show();
		$(".noidungbaiviet").hide();
		$("#dangbai").hide();
	});

	// Chức năng đang cập nhật
	$('.dangcapnhat').click(function(){
		$("[data-hidden='all']").hide();
		$('.dang-cap-nhat').show().delay(800).fadeOut();
	});

	//Ẩn/Hiện hand-click sau khi load trang
	setTimeout(function(){
		$('.hand-click').fadeIn();
	}, 500);
	$('#control').mouseenter(function(){
		$('.hand-click').fadeOut();
	});

	$('input:radio[name=price-type]').change(function(){
		$('#dangbai .price-form i').removeClass();
		if (this.value != "khac"){
			$('#dangbai .price-form').show();
			$('#dangbai .price-form i').addClass("icon-" + this.value);
		}
		else {
			$('#dangbai .price-form').hide();
		}
		$('#dangbai .price-form input').attr("price-type", this.value);
	});

	$('#dangbai #show-errors-form-data button').click(function(){
		$('#dangbai #show-errors-form-data').fadeOut();
	});

	$('#dangbai').click(function(e){
		var show_errors = $(this).find('#show-errors-form-data');
	    // Nếu click bên ngoài đối tượng container thì ẩn nó đi
	    if (!show_errors.is(e.target) && show_errors.has(e.target).length === 0)
	    {
	        show_errors.fadeOut();
	    }
	});

});

// Load sản phẩm của thành viên
function loadSanPham(idUser){
	if (!$('#baiviet').hasClass('active')){
		if ($('.baiviet #control-baiviet').hasClass('active')){
			$('#iconLoadSanPham').show();
		}
		$('.noidungbaiviet').html('');// reset lại thông báo lỗi nếu load lần sau
		var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
		
		$.ajax({
			url: 'load-san-pham',
			type: 'POST',
			dataType: 'json',
			data:{
				_token : CSRF_TOKEN,
				'idUser' : idUser
			},
			async: true,
			success: function(data){

				$('#iconLoadSanPham').hide();
				if (data.length > 0){
					for (var i = 0; i < data.length; i++){
						$('#baiviet').addClass('active');
						$('.noidungbaiviet').append(
							'<div class="col col-4 col-md-4 col-lg-3 on"><div class="card"><div id="cardHeader"><a href="#sp'+data[i]['id']+'" data-toggle="modal" onclick="loadChiTietSanPham('+data[i]['id']+',this)"><img style="background:url(\''+data[i]["thumb"]+'\');"  class="thumbnail-san-pham"></a><i class="sp'+ data[i]['id'] +'"></i></div><div id="scrollStyle1" class="card-body"> <div class="form-inline float-left"> <i class="fas fa-users"></i><span>'+ data[i]['sum_view'] +'</span></div><div class="form-inline float-right"><i class="fas fa-thumbs-up"></i><span>'+ data[i]['sum_like'] +'</span></div><div class="clearfix"></div><h5 class="card-title mb-1"><a data-toggle="modal" href="#sp'+data[i]['id']+'" onclick="loadChiTietSanPham('+data[i]['id']+',this)">'+ data[i]['tieude'] +'</a></h5></div> <div class="card-footer p-1"> <button type="button" data-toggle="modal" data-target="#sp'+data[i]['id']+'" class="btn btn-primary btn-sm mx-1 px-2 py-0 float-left" onclick="loadChiTietSanPham('+data[i]['id']+',this)">Chi tiết</button> <button type="button" class="float-right btn btn-outline-success mx-1 px-2 py-0 btn-sm btn-del" onclick="deleteSP('+data[i]['id']+',this)">Xóa</button> <button type="button" class="float-right btn btn-outline-success mx-1 px-2 py-0 btn-sm btn-edit">Sửa</button> </div> </div> </div>'
						); 
					} 
				}
				else {
					$('.noidungbaiviet').append('<p class="m-0 text-center w-100"><strong>Chưa có sản phẩm nào.</strong></p>');
				}
			},
			error: function(data){
				$('.noidungbaiviet').html('<p class="m-0 text-center text-danger w-100"><strong>Lỗi hệ thống.</strong></br>Bạn vui lòng liên hệ với Admin để khắc phúc sự cố này.</p>');
				$('#iconLoadSanPham').hide();
			}
		});
	}
}
function loadChiTietSanPham(idSP, el){
	$('.noidungbaiviet #cardHeader i.sp'+idSP).addClass('loading-2');
	var CSRF_TOKEN = $('meta[name="_token"').attr('content');
	$.ajax({
		url: 'chi-tiet-san-pham',
		type: 'post',
		dataType: 'json',
		data: {'_token':CSRF_TOKEN, 'idsp':idSP},
		success: function(data){
			$('.noidungbaiviet i.sp'+idSP).removeClass('loading-2');
			var sanpham = data.sanpham;
			var image = data.image;
			if (sanpham.length == 1) {
				var list_img = '';
				if (image.length > 0) {
					for (var i = 0, len = image.length; i < len; i++) {
						list_img += '<p><img src="upload/source_resize/'+ image[i]['name'] +'" class="img-fluid"></p>'
					}
				}
				$('#chi-tiet-san-pham').append('<div class="modal fade" id="sp'+idSP+'" role="dialog" tabindex="-1"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header py-2"><h4 class="modal-title">'+ sanpham[0]['tieude'] +'</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div> <div class="modal-body text-center"><p>'+ sanpham[0]['noidung'] +'</p>'+ list_img +'</div><div class="modal-footer"> <div class="form-inline" style="margin-right:10%"> Hãy <label  class="like-footer"></label> để cho ta biết đại hiệp đã ghé qua nơi đây. </div> <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button> </div> </div></div></div>'); 
				$(el).removeAttr('onclick');
				$('.noidungbaiviet a[href="#sp'+ idSP +'"]').removeAttr('onclick');
				$('.noidungbaiviet button[data-target="#sp'+ idSP +'"]').removeAttr('onclick');
				$('#chi-tiet-san-pham #sp'+idSP).modal("show");
			}

		},
		error: function(data){
			$('.noidungbaiviet i.sp'+idSP).addClass('loading-2');
			console.log(data);
		}
	});
}

// Show hình ảnh trước upload
var countFile = 0;
var imageList = [];

//Kich hoat input File
function selectFile(){
    fileElem = document.getElementById("uploadfile");
    fileElem.value = null; // Set null cua input file de tranh su kien onchange k hoat dong
	fileElem.click();
}

function selectImage(files){
	if (files.length > 0){
		imageList = [];
		imageList = Array.from(files);
	}
	showMessage(files.length);
	showImage(imageList);
}

function showImage(listImage){
	$('#dangbai #filelist').html('');
	for(var i = 0; i < listImage.length; i++){
		var size = listImage[i].size;
		var tam = parseFloat(size/1024/1024).toFixed(2);
		if (tam >= 1.0){
			size = tam + " MB";
		}
		else{
			size = parseFloat(size/1024).toFixed(2) + " KB";
		}
		if (checkFileType(listImage[i]) == false || tam > 2.0 || tam === 0.0){
			$('#dangbai #filelist').append("<div class='thumb-img img-thumbnail'><img class='img-thumbnail' src='"+ URL.createObjectURL(listImage[i]) +"'><i onclick='deleteFile("+ i +")'></i> <p class='text-truncate text-danger'><small title='"+ listImage[i].name +"'>"+ listImage[i].name +"</small><br><small>"+ size +"</small></p></div>");
		}
		else
			$('#dangbai #filelist').append("<div class='thumb-img img-thumbnail'><img class='img-thumbnail' src='"+ URL.createObjectURL(listImage[i]) +"'><i onclick='deleteFile("+ i +")'></i> <p class='text-truncate'><small title='"+ listImage[i].name +"'>"+ listImage[i].name +"</small><br><small>"+ size +"</small></p></div>");

	}
		// $.ajax({
		// 	url: 'test',
		// 	type: 'post',
		// 	data: data,
		// 	contentType: false,
		// 	processData: false,
		// 	cache: false,
		// 	success: function(data){
		// 		console.log(data);
		// 	},
		// 	error: function(err){
		// 		console.log(err);
		// 	}
		// });
}
function deleteFile(index){
	imageList.splice(index,1);
	showMessage(imageList.length);
	showImage(imageList);
}

function showMessage(count){
	if (count > 0)
		$('#dangbai #showmessage').val("Đã chọn "+ count + " hình ảnh");
	else
		$('#dangbai #showmessage').val("Chưa chọn hình ảnh");
}
//Cac ham check loi data
function checkRequiredMinMax(arr, value, min, max, eltype){
	// arr la mang truyen vao de chua error
	// value la bien can check
	//min la do dai toi thieu can check
	//mã la doi dai toi da can check
	if (value.trim().length == 0){
		arr.push("Chưa nhập " + eltype.toLowerCase());
		return;
	}
	if (value.trim().length < min)
		arr.push(eltype + " quá ngắn");
	if (value.trim().length > max)
		arr.push(eltype + " vượt quá độ dài cho phép");
}
function checkFileSize(arr, filelist, maxsize){
	for (var i = 0; i < filelist.length; i++){
		var tam = Math.round((filelist[i].size / 1024 / 1024) * 1000)/1000;
		if (tam > maxsize){
			arr.push('File '+ filelist[i].name + " vượt quá kích thước cho phép (tối đa 2MB)");
		}
		else if (tam === 0.0)
			arr.push("File "+ filelist[i].name +" không hợp lệ (kích thước bằng 0)");
	}
}
function checkFileType(filelist){
	var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;
	if(!allowedExtensions.exec(filelist.type)){
    	return false;
    }
}

// Đăng sản phẩm
$(function(){
	$('#dangbai #form-dang-bai').on('submit', function(e){
		// e.stopPropagation();
		e.preventDefault();
		var accept = $('#dangbai input[name="check-xacnhan"]').is(':checked');
		if (!accept){
			alert('Vui lòng tích vào ô xác nhận');
			return false;
		}
		else{
			$('#dangbai button[type="submit"]').prop("disabled", true);
			dangSanPham();
		}
	});
});

function dangSanPham(){
	var errors = [];
	
	// Khai báo biến lấy giá trị
	var CSRF_TOKEN = $('#dangbai input[name="dangbai_token"]').val();
	var server = $('#dangbai select[name="server"]').val();
	var tieude = $('#dangbai input[name="tieude"]').val();
	var noidung = CKEDITOR.instances['noidungchitiet'].getData();

	var kieugia = '';
	if($('#dangbai .price-form input').attr('price-type') != "khac"){
		kieugia = $('#dangbai .price-form input').attr('price-type');
	}
	else{
		kieugia = 'khac';
	}

	var gia = '';
	if(kieugia == "khac")
		gia = $('#dangbai select[name="select-price"]').val();
	else
		gia = $('#dangbai .price-form input').val();

	var sdt = $('#dangbai input[name="sdt"]').val();
	var fb = $('#dangbai input[name="fb"]').val();
	var iduser = $('#dangbai button[type=submit]').attr('user-id');

	// check lỗi data lưu vào mảng errors
		// check server
	checkRequiredMinMax(errors, server, 1, 50, 'Server');
		// check lỗi tiêu đề
	checkRequiredMinMax(errors, tieude, 6, 255, 'Tiêu đề');

		// check lỗi nội dung
	checkRequiredMinMax(errors, noidung, 20, 5000, 'Nội dung');

		// check đã chọn file hay chưa
	if (imageList.length ==0)
		errors.push('Chưa chọn file');

		// check dạng file
	for (var i = 0; i < imageList.length; i++){
		if(checkFileType(imageList[i]) == false){
			errors.push('Có file không đúng định dạng (chỉ nhận .jpg/ .jpeg/ .png/ .gif)');
			break;
		}
	}
		// check kích thước file
	checkFileSize(errors, imageList, 2.0);

		// check giá
	if (kieugia != "khac"){
		if (gia.trim().length == 0)
			errors.push('Chưa định giá cho sản phẩm (giá > 0)');
		else if (gia < 0)
			errors.push("Giá không thể là số âm");
		else if (gia > 99999999)
			errors.push('Giá vượt mức cho phép');
		else {
			if (isNaN(gia))
				errors.push('Giá không thể là ký tự');
		}
	}
		// check điện thoại
	if (sdt.length > 0){
		var regex = /^[0-9][1-9][0-9]{8,9}$/;
		if (!regex.test(sdt))
			errors.push('Số điện thoại không đúng');
	}

	// check facebook
	if (fb.length > 0)
		checkRequiredMinMax(errors, fb, 4, 255, 'Link facebook');

	//Kiểm tra mảng errors và show lỗi ra màn hình
	if (errors.length > 0){
		$('#dangbai #show-errors-form-data .modal-body').html('');
		for(var i = 0; i < errors.length; i++){
			$('#dangbai #show-errors-form-data .modal-body').append("<li>"+ errors[i] +"</li>");
		}
		$('#dangbai #show-errors-form-data').show();
		$('#dangbai button[type="submit"]').prop("disabled", false);
	}
	else {
		// Nếu không có lỗi thì ajax đến controller
		$('#dangbai #show-errors-form-data .modal-body').html('');
		$('#dangbai #show-errors-form-data').fadeOut();

		var data = new FormData();
		data.append('_token', CSRF_TOKEN);
		data.append("tieude", tieude);
		data.append("server", server);
		data.append("noidung", noidung);
		data.append("kieugia", kieugia);
		data.append("gia", gia);
		data.append("sdt", sdt);
		data.append("fb", fb);
		data.append('iduser', iduser);

		for (var i = 0; i < imageList.length; i++)
			data.append("image_"+i, imageList[i]);

		data.append("length", imageList.length);
		$('#dangbai #submit-loading').addClass('loading');

		$.ajax({
			url: 'dang-bai',
			type: 'post',
			data:data,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				if (data.trim() == 'success'){
					$('#dangbai #show-errors-form-data .modal-header h6').html("* Success");
					$('#dangbai #show-errors-form-data .modal-body').addClass('text-center').append('<p style="color:green">Đăng thành công</p>')
					$('#dangbai #show-errors-form-data').show();
					// location.reload();
				}
				else {
					$('#dangbai #show-errors-form-data .modal-body').html('');
					for(var key in data){
						$('#dangbai #show-errors-form-data .modal-body').append("<li>"+ data[key] +"</li>");
					}
					$('#dangbai #show-errors-form-data').show();
					$('#dangbai button[type="submit"]').prop("disabled", false);
				}
				$('#dangbai #submit-loading').removeClass('loading');
			},
			error: function(err){
				console.log(err);
				$('#dangbai #submit-loading').removeClass('loading');
				$('#dangbai button[type="submit"]').prop("disabled", false);
			}
		});
	}
}

function deleteSP(idSP, el) {
	var accept = confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');
	var _token = $('meta[name="_token"]').attr('content');
	if (accept) {
		$.ajax({
			url:'xoa-san-pham',
			type: 'post',
			data: {'idsp':idSP,'_token':_token},
			success: function(data){
				if (data == 'success'){
					$(el).parent().parent().parent().removeClass('on');
					$(el).parent().parent().parent().remove();
				}
				if ($('.noidungbaiviet').contents().length == 0){
					$('.noidungbaiviet').append('<p class="m-0 text-center w-100"><strong>Chưa có sản phẩm nào.</strong></p>');
					$('#baiviet').removeClass('active');
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}
}
