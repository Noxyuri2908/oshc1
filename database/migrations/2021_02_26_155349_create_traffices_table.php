<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_view')->nullable();
            $table->integer('total_user')->nullable();
            $table->integer('total_like')->nullable();
            $table->integer('total_reach')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('traffices');
    }
}
