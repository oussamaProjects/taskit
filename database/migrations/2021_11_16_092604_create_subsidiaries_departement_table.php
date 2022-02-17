<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsidiariesDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiaries_departement', function (Blueprint $table) {
            $table->unsignedInteger('departement_id');
            $table->unsignedInteger('subs_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('departement_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('subs_id')->references('id')->on('subsidiaries')->onDelete('cascade');

            $table->primary(['departement_id', 'subs_id']);

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
        Schema::dropIfExists('subsidiaries_departement');
    }
}
