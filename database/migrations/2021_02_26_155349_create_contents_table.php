<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('link')->nullable();
            $table->text('des_s')->nullable();
            $table->text('des_f')->nullable();
            $table->string('image')->nullable();
            $table->integer('pos')->nullable();
            $table->integer('section_id');
            $table->integer('type')->nullable();
            $table->string('note')->nullable();
            $table->integer('created_by');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('contents');
    }
}
