<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('thumb');
            $table->string('tieude');
            $table->longText('noidung');
            $table->string('kieugia');
            $table->string('gia')->default('0');

            $table->unsignedInteger('idServer');
            $table->foreign('idServer')->references('id')->on('server_games');

            $table->unsignedInteger('idLikeView');
            $table->foreign('idLikeView')->references('id')->on('like_views')->onDelete('cascade');

            $table->unsignedInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('san_phams');
    }
}
