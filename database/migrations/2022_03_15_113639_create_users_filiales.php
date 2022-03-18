<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFiliales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_filiales', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('filiale_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('filiale_id')->references('id')->on('subsidiaries')->onDelete('cascade');


            $table->primary(['user_id','filiale_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_filiales');
    }
}
