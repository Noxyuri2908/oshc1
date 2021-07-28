<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('facebook')->nullable();
            $table->text('note')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('email')->nullable();
            $table->string('skype')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->string('is_receive_comm', 255)->nullable();
            $table->string('acc_name', 255)->nullable();
            $table->string('bank', 255)->nullable();
            $table->string('currency', 255)->nullable();
            $table->string('bank_address', 255)->nullable();
            $table->string('receiver_address', 255)->nullable();
            $table->string('swift_code', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
