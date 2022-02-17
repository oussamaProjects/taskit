<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_subsidiaries', function (Blueprint $table) {
            $table->unsignedInteger('document_id');
            $table->unsignedInteger('subs_id');
            $table->integer('permission_for');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            $table->foreign('subs_id')->references('id')->on('subsidiaries')->onDelete('cascade');

            $table->primary(['document_id', 'subs_id']);

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
        Schema::dropIfExists('document_subsidiaries');
    }
}
