<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoahongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoahongs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->integer('com_payment_method')->nullable();
            $table->string('policy_no')->nullable();
            $table->integer('visa_status')->nullable();
            $table->integer('hoahong_month')->nullable();
            $table->integer('hoahong_year')->nullable();
            $table->date('issue_date')->nullable();
            $table->integer('policy_status')->nullable();
            $table->date('date_payment_provider')->nullable();
            $table->date('date_payment_agent')->nullable();
            $table->integer('payment_note_provider')->nullable();
            $table->string('account_bank')->nullable();
            $table->text('note')->nullable();
            $table->float('extra_money')->nullable();
            $table->integer('unit_money')->nullable();
            $table->date('extra_time')->nullable();
            $table->integer('admin_create')->nullable();
            $table->integer('admin_update')->nullable();
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
        Schema::dropIfExists('hoahongs');
    }
}
