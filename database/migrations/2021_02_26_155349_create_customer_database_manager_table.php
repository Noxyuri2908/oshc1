<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDatabaseManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_database_manager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_of_customer_id')->nullable();
            $table->string('full_name')->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('english_center_id')->nullable();
            $table->integer('event_id')->nullable();
            $table->text('identification')->nullable();
            $table->integer('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mail')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fb')->nullable();
            $table->string('social_link')->nullable();
            $table->string('country_id')->nullable();
            $table->string('city_name')->nullable();
            $table->string('school_name')->nullable();
            $table->integer('study_tour')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('destination_to_study')->nullable();
            $table->integer('potentiality')->nullable();
            $table->integer('potential_service')->nullable();
            $table->integer('email_status')->nullable();
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
        Schema::dropIfExists('customer_database_manager');
    }
}
