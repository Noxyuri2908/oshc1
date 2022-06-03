<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSkypeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_skype_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('domain_id')->nullable();
            $table->string('email')->nullable();
            $table->integer('person_in_charge')->nullable();
            $table->string('password')->nullable();
            $table->string('skype')->nullable();
            $table->string('crm')->nullable();
            $table->string('dropbox')->nullable();
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
        Schema::dropIfExists('mail_skype_lists');
    }
}
