<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('bn2_'.'user', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("username");
            $table->string("salt");
            $table->string("password");
            $table->string("confirmcode");
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
        Schema::drop('bn2_'.'user');
    }
}
