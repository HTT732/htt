<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\LoaiTin;
use App\User;

class MessageController extends Controller
{
    function getMessage () {
    	$message = Message::all();
    	$loaitin = LoaiTin::all();
    	$user = User::where('level', '<>', 'Super Admin')->select('username')->get();
    	return view('admins.message', compact('message', 'loaitin', 'user'));
    }
}
