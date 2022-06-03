<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->integer('admin_create')->nullable();
            $table->integer('admin_update')->nullable();
            $table->double('refund_provider_amount', 8, 2)->nullable()->default(0.00);
            $table->date('refund_provider_date')->nullable();
            $table->text('note')->nullable();
            $table->float('std_deduction', 10, 0)->nullable()->default(0);
            $table->double('refund_provider_exchange_rate', 8, 2)->nullable()->default(0.00);
            $table->date('std_date_apyment')->nullable();
            $table->date('request_date')->nullable();
            $table->integer('std_status')->nullable();
            $table->text('std_note')->nullable();
            $table->float('std_exchange_rate', 10, 0)->nullable()->default(0);
            $table->float('std_amount', 10, 0)->default(0);
            $table->text('note2')->nullable();
            $table->timestamps();
            $table->float('refund_profit_2', 10, 0)->nullable();
            $table->float('refund_profit_2_VN', 10, 0)->nullable();
            $table->float('refund_amount_com_agent', 10, 0)->nullable();
            $table->float('refund_exchange_rate_agent', 10, 0)->nullable();
            $table->float('refund_agent_vnd', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refunds');
    }
}
