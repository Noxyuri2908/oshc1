<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id');
            $table->integer('benefit_id');
            $table->string('note')->nullable();
            $table->string('note_cn', 255)->nullable();
            $table->string('note_vi', 255)->nullable();
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
        Schema::dropIfExists('confs');
    }
}
