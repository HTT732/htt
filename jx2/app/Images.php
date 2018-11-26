<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = "images";

    public $timesstamps = false;

    public function sanPham(){
    	return $this->belongsTo('App\SanPham', 'idSanPham', 'id');
    }
}
