<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuthusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieuthus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apply_id');
            $table->string('payer')->nullable();
            $table->string('address')->nullable();
            $table->string('account_bank', 255)->nullable();
            $table->text('note')->nullable();
            $table->string('code')->nullable();
            $table->float('amount', 10, 0)->nullable();
            $table->float('current_id', 10, 0)->nullable();
            $table->float('bank_fee')->nullable();
            $table->integer('type')->nullable();
            $table->integer('type_payment')->nullable();
            $table->integer('admin_create')->nullable();
            $table->integer('admin_update')->nullable();
            $table->timestamps();
            $table->float('receipt_net_amount', 10, 0)->nullable();
            $table->date('date_receipt')->nullable();
            $table->float('exchange_rate', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieuthus');
    }
}
