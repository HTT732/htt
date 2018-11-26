<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = "bai_viets";

    public function likeView() {
    	return $this->belongsTo('App\LikeView', 'idLikeView', 'id');
    }

    public function comment() {
    	return $this->hasMany('App\Comment', 'idBaiViet', 'id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
