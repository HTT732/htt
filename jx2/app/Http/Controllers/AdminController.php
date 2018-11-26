<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	function getIndex(){
		return view('clients.index');
	}
}
