<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_benefits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_cn', 255);
            $table->string('name_vi', 255);
            $table->text('des_s')->nullable();
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
        Schema::dropIfExists('cat_benefits');
    }
}
