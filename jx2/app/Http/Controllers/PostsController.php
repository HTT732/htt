<?php

namespace App\Http\Controllers;

use App\SanPham;
use App\Slide;
use App\User;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;

class PostsController extends Controller
{
    function getSonTrang () {
    	$countSP = SanPham::all()->count();
    	Session::put('countProduct', $countSP);
    	$sp0 = SanPham::all()->first(); 
    	$timeabc = $sp0->created_at->diffForHumans();

        $slide = Slide::all()->toJson();
        $sanpham = User::join('san_phams', 'users.id', 'san_phams.idUser')->join('like_views', 'san_phams.idLikeView', 'like_views.id')->join('server_games', 'san_phams.idServer', 'server_games.id')->join('images', 'san_phams.id', 'images.idSanPham')->select('users.id', 'users.username', 'users.nickname', 'users.sdt', 'users.fb', 'users.level', 'san_phams.id', 'san_phams.tieude', 'san_phams.thumb', 'san_phams.noidung', 'san_phams.kieugia', 'san_phams.gia', 'san_phams.created_at', 'server_games.serverName', 'like_views.sum_like', 'like_views.sum_view')->selectRaw('GROUP_CONCAT(images.name) as images')->groupBy('users.id', 'users.username', 'users.nickname', 'users.sdt', 'users.fb', 'users.level', 'san_phams.id', 'san_phams.tieude', 'san_phams.thumb', 'san_phams.noidung', 'san_phams.kieugia', 'san_phams.gia', 'san_phams.created_at', 'server_games.serverName', 'like_views.sum_like', 'like_views.sum_view')->orderBy('san_phams.id', 'DESC')->get()->toJson();
        return view('clients.posts', compact('slide','sanpham','countSP', 'timeabc'));
    }

}
