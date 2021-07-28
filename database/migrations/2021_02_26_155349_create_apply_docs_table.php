<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->integer('admin_create')->nullable();
            $table->integer('admin_update')->nullable();
            $table->text('name')->nullable();
            $table->text('link')->nullable();
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
        Schema::dropIfExists('apply_docs');
    }
}
