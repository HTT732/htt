<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sanPham() {
        return $this->hasMany('App\SanPham');
    }
 
    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public function baiViet() {
        return $this->hasMany('App\BaiViet');
    }
}
