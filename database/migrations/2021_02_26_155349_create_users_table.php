<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('staff_id')->nullable();
            $table->string('shares', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('is_default')->nullable();
            $table->integer('had_case')->nullable();
            $table->date('first_case_date')->nullable();
            $table->text('note1')->nullable();
            $table->text('note2')->nullable();
            $table->text('potential_service')->nullable();
            $table->date('registered_date')->nullable();
            $table->string('agent_code', 255)->nullable();
            $table->string('rating')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('office')->nullable();
            $table->string('department')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('market_id', 255)->nullable();
            $table->string('tel_1', 255)->nullable();
            $table->string('tel_2', 255)->nullable();
            $table->string('fb', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->integer('person_in_charge')->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->text('note')->nullable();
            $table->integer('type')->nullable();
            $table->integer('type_agent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
