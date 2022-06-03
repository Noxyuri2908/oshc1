<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner');
            $table->string('background_footer');
            $table->string('content');
            $table->string('content_vi');
            $table->string('content_cn');
            $table->integer('type')->unique();
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
        Schema::dropIfExists('temp_mails');
    }
}
