<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('service_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->double('comm', 8, 2);
            $table->integer('unit')->nullable();
            $table->integer('donvi')->nullable();
            $table->integer('type_payment')->nullable()->default(1);
            $table->date('validity_start_date')->nullable();
            $table->tinyInteger('gst')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->integer('policy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions');
    }
}
