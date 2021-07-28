<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('content');
            $table->text('name_cn');
            $table->text('name_vi');
            $table->text('content_cn');
            $table->text('content_vi');
            $table->integer('area_id')->nullable();
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
        Schema::dropIfExists('qas');
    }
}
