<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dichvu_id')->nullable();
            $table->string('name');
            $table->string('country', 255)->nullable();
            $table->string('slug')->unique();
            $table->string('image');
            $table->double('price', 8, 2);
            $table->string('link')->nullable();
            $table->text('des_s')->nullable();
            $table->text('des_f')->nullable();
            $table->integer('type')->nullable();
            $table->integer('price_type')->default(0);
            $table->integer('pos')->nullable();
            $table->string('note')->nullable();
            $table->string('currency_id', 255)->nullable();
            $table->integer('created_by');
            $table->string('email', 255)->nullable();
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
        Schema::dropIfExists('services');
    }
}
