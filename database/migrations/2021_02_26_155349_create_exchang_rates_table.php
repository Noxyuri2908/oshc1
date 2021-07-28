<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchang_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->string('unit')->nullable();
            $table->double('rate', 8, 2)->nullable();
            $table->integer('type')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->integer('quarter_id')->nullable();
            $table->float('unit_to_aud', 10, 0)->nullable();
            $table->float('aud_to_vnd', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchang_rates');
    }
}
