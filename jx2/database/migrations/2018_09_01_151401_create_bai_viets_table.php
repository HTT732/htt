<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiVietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude');
            $table->longText('noidung');

            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('idLikeView');
            $table->foreign('idLikeView')->references('id')->on('like_views')->onDelete('cascade');
            
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
        Schema::dropIfExists('bai_viets');
    }
}
