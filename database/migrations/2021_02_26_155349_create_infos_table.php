<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->string('registered_date')->nullable();
            $table->string('agent_code')->nullable();
            $table->string('rating')->nullable();
            $table->string('status')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('office')->nullable();
            $table->string('department', 255)->nullable();
            $table->integer('type_id')->nullable()->comment('Type of agent');
            $table->text('market_id')->nullable()->comment('Martket');
            $table->string('tel_1')->nullable();
            $table->string('tel_2')->nullable();
            $table->string('fb')->nullable();
            $table->string('website')->nullable();
            $table->integer('person_in_charge')->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->text('note')->nullable();
            $table->integer('type')->default(0);
            $table->integer('type_agent')->nullable();
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
        Schema::dropIfExists('infos');
    }
}
