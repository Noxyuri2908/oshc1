<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTailieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tailieus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('name')->nullable();
            $table->text('link')->nullable();
            $table->string('type_file')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('tailieus');
    }
}
