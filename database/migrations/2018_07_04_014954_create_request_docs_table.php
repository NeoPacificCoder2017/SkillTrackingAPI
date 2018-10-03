<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->string('method');
            $table->text('response');
            $table->text('description');
            $table->string('color');
            $table->integer('user_type_id');
            $table->timestamps();
            // $table->string('name_parameter');
            // $table->string('type_parameter');
            // $table->string('position_parameter');
            // $table->integer('required_parameter');
            // $table->string('description_parameter');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_docs');
    }
}
