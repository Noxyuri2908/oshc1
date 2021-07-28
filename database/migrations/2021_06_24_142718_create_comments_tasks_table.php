<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('follow_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('staff_create_fl')->nullable();
            $table->integer('staff_assign_fl')->nullable();
            $table->integer('staff_create_cm')->nullable();
            $table->longText('comment')->nullable();
            $table->integer('see')->nullable();
            $table->integer('send_to_staff_id')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('comments_tasks');
    }
}
