<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
     function getSlide () {
     	$slide = Slide::all();
    	return view('admins.slide', ['slide'=>$slide]);
    }
}
