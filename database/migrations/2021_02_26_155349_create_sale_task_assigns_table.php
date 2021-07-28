<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTaskAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_task_assigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('processing_date')->nullable();
            $table->string('item')->nullable();
            $table->integer('type')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->text('note')->nullable();
            $table->integer('type_table');
            $table->timestamps();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_task_assigns');
    }
}
