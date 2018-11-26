<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    function getThongke () {
    	return view('admins.thongke');
    }
}
