<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude');
            $table->longText('noidung');
            $table->dateTime('thoigian');
            $table->string('nguoigui', 100);
            $table->string('nguoinhan', 100);

            $table->unsignedInteger('idLoaiTin');
            $table->foreign('idLoaiTin')->references('id')->on('loai_tins')->onDelete('cascade');
            
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
        Schema::dropIfExists('messages');
    }
}
