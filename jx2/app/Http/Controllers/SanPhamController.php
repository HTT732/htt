<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;
class SanPhamController extends Controller
{
     function getSanPham () {
     	$sanpham = SanPham::all();

    	return view('admins.sanpham', ['sanpham'=>$sanpham]);
    }
}
