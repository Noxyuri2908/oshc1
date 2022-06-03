<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostpitalAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_accesses', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->integer('service_id')->nullable();
            $table->integer('policy')->nullable();
            $table->longText('hostpital_access')->nullable();
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
        Schema::dropIfExists('hostpital_access');
    }
}
