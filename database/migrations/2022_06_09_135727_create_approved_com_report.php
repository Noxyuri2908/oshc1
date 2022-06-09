<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovedComReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approved_com_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id');
            $table->tinyInteger('report_type');
            $table->tinyInteger('month');
            $table->smallInteger('year');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('report_file', 255);
            $table->decimal('amount', 18, 2);
            $table->integer('checked_by')->nullable();
            $table->dateTime('checked_date')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->integer('approved_by')->nullable();
            $table->dateTime('emailed_date')->nullable();
            $table->tinyInteger('agent_request')->nullable()->default(1);
            $table->tinyInteger('final_approve')->nullable()->default(1);
            $table->dateTime('paid_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('approved_com_report');
    }
}
