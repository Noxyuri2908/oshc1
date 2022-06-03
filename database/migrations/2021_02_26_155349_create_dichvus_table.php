<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDichvusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dichvus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('viettat', 255)->nullable();
            $table->string('slug');
            $table->integer('type_form');
            $table->integer('pos')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->integer('service_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dichvus');
    }
}
