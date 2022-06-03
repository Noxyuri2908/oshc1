<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteAndAccountServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_and_account_service_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->nullable();
            $table->string('website')->nullable();
            $table->string('service')->nullable();
            $table->string('link')->nullable();
            $table->string('website_and_service_id')->nullable();
            $table->string('password')->nullable();
            $table->string('supporter')->nullable();
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
        Schema::dropIfExists('website_and_account_service_lists');
    }
}
