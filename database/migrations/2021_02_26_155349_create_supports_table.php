<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->string('task', 255)->nullable();
            $table->integer('task_type')->nullable();
            $table->integer('level')->nullable();
            $table->integer('status')->nullable();
            $table->integer('leader')->nullable();
            $table->integer('process_by')->nullable();
            $table->text('person_in_charge')->nullable();
            $table->string('from_date', 255)->nullable();
            $table->string('to_date', 255)->nullable();
            $table->string('processing', 255)->nullable();
            $table->text('content')->nullable();
            $table->integer('type')->default(1);
            $table->integer('apply_id')->nullable();
            $table->timestamps();
            $table->string('service', 255)->nullable();
            $table->string('type_service', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
