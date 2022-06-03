<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nibs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id')->nullable();
            $table->integer('type')->nullable();
            $table->double('price')->nullable();
            $table->integer('num_days')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('nibs');
    }
}
