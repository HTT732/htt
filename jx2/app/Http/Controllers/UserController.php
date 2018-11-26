<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function getUser () {
    	$user = User::all();
    	return view('admins.user', compact('user'));
    }
}
