<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainHostingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain-hosting-lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->nullable();
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('user')->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->integer('person_in_charge')->nullable();
            $table->string('email_in_charge')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('fee')->nullable();
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
        Schema::dropIfExists('domain-hosting-lists');
    }
}
