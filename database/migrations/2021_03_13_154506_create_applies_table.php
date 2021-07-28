<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agent_id')->nullable();
            $table->integer('master_agent')->nullable();
            $table->string('service_country', 255)->nullable();
            $table->integer('type_service')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('type_invoice')->nullable();
            $table->integer('policy')->nullable();
            $table->integer('no_of_adults')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->integer('type_visa')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('net_amount', 10, 0)->nullable()->default(0);
            $table->string('ref_no', 255)->nullable();
            $table->integer('promotion_id')->nullable();
            $table->float('promotion_amount', 10, 0)->nullable()->default(0);
            $table->float('bank_fee', 10, 0)->nullable()->default(0);
            $table->integer('payment_method')->nullable();
            $table->float('gst', 10, 0)->nullable()->default(0);
            $table->float('surcharge', 10, 0)->nullable()->default(0);
            $table->float('extra', 10, 0)->nullable()->default(0);
            $table->integer('type_extra')->nullable()->default(1);
            $table->float('comm', 10, 0)->nullable()->default(0);
            $table->float('total', 10, 0)->nullable()->default(0);
            $table->integer('staff_id')->nullable();
            $table->integer('status')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->string('invoice_code', 255)->nullable();
            $table->integer('location_australia')->nullable();
            $table->float('bank_fee_number', 10, 0)->nullable();
            $table->text('remind_status')->nullable();
            $table->tinyInteger('has_email')->nullable();
            $table->integer('type_of_payment_fw')->nullable();
            $table->text('education_email_agent')->nullable();
            $table->float('amount_from', 10, 0)->nullable();
            $table->integer('amount_from_unit')->nullable();
            $table->string('payment_come_from', 255)->nullable();
            $table->float('amount_to', 10, 0)->nullable();
            $table->integer('amount_to_unit')->nullable();
            $table->date('initiated_date')->nullable();
            $table->string('std_id', 255)->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('type_get_data_payment')->nullable();
            $table->date('processing_date_remind')->nullable();
            $table->string('remind_note')->nullable();
            $table->integer('customer_manager_id')->nullable();
            $table->string('invoice_code_link', 255)->nullable();
            $table->date('delivered_date')->nullable();
            $table->integer('type_payment_agent_id')->nullable();
            $table->integer('count_month')->nullable();
            $table->integer('count_day')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applies');
    }
}
