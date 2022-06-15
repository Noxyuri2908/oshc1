<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOshcReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oshc_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('com_reports_id');
            $table->integer('customer_id');
            $table->integer('provider_id');
            $table->integer('policy');
            $table->integer('no_of_adults');
            $table->integer('no_of_children');
            $table->decimal('amount', 18, 2)->nullable()->default(0);
            $table->decimal('com_percent', 18, 2)->nullable()->default(0);
            $table->decimal('com', 18, 2)->nullable()->default(0);
            $table->decimal('total', 18, 2)->nullable()->default(0);
            $table->decimal('extra', 18, 2)->nullable()->default(0);
            $table->decimal('exchange_rate', 18, 2)->nullable()->default(0);
            $table->decimal('gst', 18, 2)->nullable()->default(0);
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
        Schema::dropIfExists('oshc_reports');
    }
}
