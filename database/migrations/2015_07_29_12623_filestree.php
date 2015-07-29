<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Filestree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger("filename_id");
            $table->string("hashset_filename");
            $table->string("filename");
            $table->binary("content_file");
            $table->boolean("isHashed");
            $table->boolean("isClear");
            $table->string("isCrypted");
            $table->bigInteger("user_id");
            $table->string("mime");
            $table->boolean("isDirectory");
            $table->foreign('user_id')
      ->references('id')->on('user')
      ->onDelete('cascade');
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
        Schema::drop('data');
    }
}
