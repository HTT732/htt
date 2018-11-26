<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerGame extends Model
{
    protected $table = "server_games";

    public $timestamps = false;

    public function sanPham(){
    	return hasMany('App\SanPham', 'idServer', 'id');
    }
}
