<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;



Route::prefix('admin')->middleware('checkAdmin')->group(function () {
	Route::prefix('san-pham')->group(function () {
	    Route::get('/', 'SanPhamController@getSanPham')->name('sanpham');

	});
	Route::prefix('bai-viet')->group(function () {
	    Route::get('/', 'BaiVietController@getBaiViet')->name('baiviet');

	});
	Route::prefix('user')->group(function () {
	    Route::get('/', 'UserController@getUser')->name('user');

	});
	Route::prefix('comment')->group(function () {
	    Route::get('/', 'CommentController@getComment')->name('comment');
	});
	Route::prefix('message')->group(function () {
	    Route::get('/', 'MessageController@getMessage')->name('message');

	});
	Route::prefix('thong-ke')->group(function () {
	    Route::get('/', 'ThongKeController@getThongKe')->name('thongke');

	});
	Route::prefix('slide')->group(function () {
	    Route::get('/', 'SlideController@getSlide')->name('slide');

	});
   
});

// Trang chu
Route::get('/', 'ClientController@getTrangChu')->name('trangchu');
Route::get('register', 'ClientController@getRegister')->name('dangky');
Route::post('register', 'ClientController@postRegister')->name('postdangky');
Route::post('check-username', 'ClientController@checkUsername');
Route::get('login', 'ClientController@getLogin')->name('dangnhap');
Route::post('login', 'ClientController@postLogin')->name('dangnhap');
Route::get('logout', 'ClientController@getLogout')->name('dangxuat');
Route::post('load-san-pham', 'ClientController@loadSanPham');
Route::post('dang-bai', 'ClientController@dangBai')->name('dangbai');
Route::post('chi-tiet-san-pham', 'ClientController@loadChiTietSanPham');
Route::post('xoa-san-pham', 'ClientController@xoaSanPham');

// Son Trang
Route::get('son-trang', 'PostsController@getSonTrang')->name('sontrang');
// Route::get('product-status', 'PostsController@productStatus');

// Tra dao quan
Route::get('tra-dao-quan', 'ClientController@getTraDaoQuan')->name('tradaoquan');

//##############################
Route::get('xoa-cache', function(){
	return Cache::pull('sanpham');
});

Route::get('test', function(){
	return 'success';
});



