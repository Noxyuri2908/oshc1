<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->date('process_date')->nullable();
            $table->integer('status')->nullable();
            $table->string('rating')->nullable();
            $table->integer('contact_by')->nullable();
            $table->text('des')->nullable();
            $table->integer('type')->nullable()->default(1);
            $table->integer('person_in_charge')->nullable();
            $table->timestamps();
            $table->text('potential_service')->nullable();
            $table->integer('condition_follow')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
