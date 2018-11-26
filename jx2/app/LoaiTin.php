<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    protected $table = "loai_tins";

    public $timestamps = false;

    public function message() {
    	return $this->hasMany('App\Message', 'idLoaiTin', 'id');
    }
}
