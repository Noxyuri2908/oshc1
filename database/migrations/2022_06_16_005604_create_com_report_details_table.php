<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_report_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('com_report_id');
            $table->string('fullname');
            $table->string('service');
            $table->string('provider');
            $table->integer('policy');
            $table->integer('no_of_adults');
            $table->integer('no_of_children');
            $table->decimal('amount', 18, 2)->nullable()->default(0);
            $table->decimal('com_percent', 18, 2)->nullable()->default(0);
            $table->decimal('com', 18, 2)->nullable()->default(0);
            $table->decimal('total', 18, 2)->nullable()->default(0);
            $table->decimal('total_AUD', 18, 2)->nullable()->default(0);
            $table->decimal('extra', 18, 2)->nullable()->default(0);
            $table->decimal('exchange_rate', 18, 2)->nullable()->default(0);
            $table->decimal('gst', 18, 2)->nullable()->default(0);
            $table->decimal('comm_inc_gst', 18, 2)->nullable()->default(0);
            $table->decimal('comm_exc_gst', 18, 2)->nullable()->default(0);
            $table->decimal('recall_com', 18, 2)->nullable()->default(0);
            $table->decimal('bonus', 18, 2)->nullable()->default(0);
            $table->string('com_status');
            $table->string('visa_status');
            $table->string('note');
            $table->dateTime('date_of_payment')->nullable();
            $table->dateTime('date_of_policy')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
        Schema::dropIfExists('com_report_details');
    }
}
