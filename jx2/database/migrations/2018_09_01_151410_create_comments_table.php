<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('noidung');
            $table->dateTime('thoigian');
            
            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('idBaiViet');
            $table->foreign('idBaiViet')->references('id')->on('bai_viets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
