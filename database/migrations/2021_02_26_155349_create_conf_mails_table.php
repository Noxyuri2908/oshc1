<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_vi');
            $table->string('name_cn');
            $table->string('type')->unique();
            $table->string('content');
            $table->string('content_vi');
            $table->string('content_cn');
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
        Schema::dropIfExists('conf_mails');
    }
}
