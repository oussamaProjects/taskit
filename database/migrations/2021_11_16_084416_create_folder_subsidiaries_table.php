<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_subsidiaries', function (Blueprint $table) {
            $table->unsignedInteger('folder_id');
            $table->unsignedInteger('subs_id');
            $table->integer('permission_for');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('subs_id')->references('id')->on('subsidiaries')->onDelete('cascade');

            $table->primary(['folder_id', 'subs_id']);

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
        Schema::dropIfExists('folder_subsidiaries');
    }
}
