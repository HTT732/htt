<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
Use App\User;

class CommentController extends Controller
{
    function getComment () {
    	$comment = Comment::all();
    	$user = User::all();
    	return view('admins.comment', compact('comment', 'user'));
    }
}
