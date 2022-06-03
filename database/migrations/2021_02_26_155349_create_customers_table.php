<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->string('prefix_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->nullable();
            $table->string('birth_of_date')->nullable();
            $table->string('passport')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('place_study')->nullable();
            $table->string('student_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('is_locate')->nullable();
            $table->integer('type');
            $table->string('education_agent')->nullable();
            $table->string('agent_code')->nullable();
            $table->string('fb', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('destination', 11)->nullable();
            $table->string('provider_of_school', 255)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
