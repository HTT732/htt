<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    public function baiViet() {
    	return $this->belongsTo('App\BaiViet', 'idBaiViet', 'id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
