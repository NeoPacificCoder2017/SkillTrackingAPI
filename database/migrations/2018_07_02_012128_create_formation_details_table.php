<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formation_id'); //référence dans la table formations
            $table->integer('module_id'); //référence dans la table modules
            // $table->string('start_date');
            // $table->string('end_date');
            $table->integer('teacher_id'); //référence dans la table users
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
        Schema::dropIfExists('formation_details');
    }
}
