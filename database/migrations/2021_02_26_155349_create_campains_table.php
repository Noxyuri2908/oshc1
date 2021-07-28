<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code', 255)->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('staff_id');
            $table->tinyInteger('is_send_email');
            $table->tinyInteger('is_send_sms');
            $table->text('note')->nullable();
            $table->text('subject')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('status');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('campains');
    }
}
