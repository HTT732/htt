<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "san_phams";

    public function user() {
    	return $this->belongsTo('App\User', 'idUser', 'id');
    }

    public function likeView() {
    	return $this->belongsTo('App\LikeView', 'idSanPham', 'id');
    }

    // public function image() {
    // 	return $this->hasMany('App\Images', 'idSanPham', 'id');
    // }
}
