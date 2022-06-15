<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('agent_id');
            $table->integer('approved_com_id');
            $table->tinyInteger('report_type');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('com_reports');
    }
}
