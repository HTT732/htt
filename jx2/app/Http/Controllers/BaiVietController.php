<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaiViet;

class BaiVietController extends Controller
{
    function getBaiViet () {
    	$baiviet = BaiViet::all();
    	return view('admins.baiviet', compact('baiviet'));
    }
}
