<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progressions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id'); //référence dans la table users
            $table->integer('skill_id'); //référence dans la table skills
            $table->integer('student_validation')->default(0); 
            $table->timestamp('student_validation_date')->nullable(); 
            $table->integer('teacher_validation')->default(0);  
            $table->timestamp('teacher_validation_date')->nullable(); 
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
        Schema::dropIfExists('progressions');
    }
}
