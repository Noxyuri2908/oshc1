<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderComsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_coms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provider_id');
            $table->integer('policy')->nullable();
            $table->float('amount', 10, 0)->default(0);
            $table->integer('type')->nullable();
            $table->string('validity_date')->nullable();
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
        Schema::dropIfExists('provider_coms');
    }
}
