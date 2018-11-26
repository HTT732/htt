<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeView extends Model
{
    protected $table="like_views";

    public function baiViet() {
    	return $this->belongsTo('App\BaiViet', 'idBaiViet', 'id');
    }

    public function sanPham() {
    	return $this->belongsTo('App\SanPham', 'idSanPham', 'id');
    }
}
