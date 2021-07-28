<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->double('exchange_rate_re_provider', 8, 2)->nullable()->default(0.00);
            $table->date('date_of_receipt')->nullable();
            $table->string('note_of_receipt')->nullable();
            $table->double('pay_provider_bank_fee', 8, 2)->nullable()->default(0.00);
            $table->double('pay_provider_exchange_rate', 8, 2)->nullable()->default(0.00);
            $table->date('pay_provider_date')->nullable();
            $table->string('pay_provider_bank_account')->nullable();
            $table->double('pay_agent_bonus', 8, 2)->nullable()->default(0.00);
            $table->double('pay_agent_deduction', 8, 2)->nullable()->default(0.00);
            $table->double('pay_agent_exchange_rate', 8, 2)->nullable()->default(0.00);
            $table->date('pay_agent_date')->nullable();
            $table->float('pay_provider_paid', 10, 0)->nullable()->default(0);
            $table->double('profit_extra_money', 8, 2)->nullable()->default(0.00);
            $table->double('profit_exchange_rate', 8, 2)->nullable()->default(0.00);
            $table->integer('visa_status')->nullable();
            $table->integer('visa_month')->nullable();
            $table->integer('visa_year')->nullable();
            $table->integer('profit_status')->nullable();
            $table->integer('comm_status')->nullable();
            $table->integer('admin_create')->nullable();
            $table->integer('admin_update')->nullable();
            $table->timestamps();
            $table->float('pay_provider_amount', 10, 0)->nullable();
            $table->float('pay_provider_total_amount', 10, 0)->nullable();
            $table->float('pay_provider_total_VN', 10, 0)->nullable();
            $table->float('pay_provider_balancer_1', 10, 0)->nullable();
            $table->text('profit_payment_note_provider')->nullable();
            $table->float('profit_money', 10, 0)->nullable();
            $table->float('profit_money_VND', 10, 0)->nullable();
            $table->text('comm_re')->nullable();
            $table->float('re_total_amount', 10, 0)->nullable();
            $table->float('re_total_amount_vn', 10, 0)->nullable();
            $table->text('comm_rate_agent_profit')->nullable();
            $table->float('pay_agent_amount_comm', 10, 0)->nullable();
            $table->float('pay_agent_amount_VN', 10, 0)->nullable();
            $table->text('gst_status_agent_profit')->nullable();
            $table->date('issue_date_com_agent')->nullable();
            $table->float('com_from_provider_cp', 10, 0)->nullable();
            $table->float('exchange_in_aud_cp', 10, 0)->nullable();
            $table->float('com_in_aud_cp', 10, 0)->nullable();
            $table->date('provider_paid_date_cp')->nullable();
            $table->float('com_agent_cp', 10, 0)->nullable();
            $table->float('com_for_agent_aud_cp', 10, 0)->nullable();
            $table->float('exchange_rate_cp', 10, 0)->nullable();
            $table->float('com_for_agent_vnd_cp', 10, 0)->nullable();
            $table->date('paid_com_date_agent_cp')->nullable();
            $table->integer('com_status_cp')->nullable();
            $table->float('profit_aud_cp', 10, 0)->nullable();
            $table->float('profit_vnd_cp', 10, 0)->nullable();
            $table->text('note_cp')->nullable();
            $table->integer('staff_id_cp')->nullable();
            $table->integer('look_payment_form')->nullable();
            $table->double('pay_agent_extra', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profits');
    }
}
