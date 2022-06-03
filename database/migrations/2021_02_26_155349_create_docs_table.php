<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_vi', 255);
            $table->string('name_cn', 255);
            $table->string('link');
            $table->text('des_s')->nullable();
            $table->integer('service_id');
            $table->integer('created_by');
            $table->integer('pos')->nullable();
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
        Schema::dropIfExists('docs');
    }
}
