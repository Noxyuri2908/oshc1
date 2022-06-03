<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAdwordMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_adword_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('website_id')->nullable();
            $table->string('campaign')->nullable();
            $table->string('location_search')->nullable();
            $table->string('language_search')->nullable();
            $table->string('type_campaign')->nullable();
            $table->string('bid_price')->nullable();
            $table->string('keyword')->nullable();
            $table->string('title_1')->nullable();
            $table->string('title_2')->nullable();
            $table->string('title_3')->nullable();
            $table->string('describe')->nullable();
            $table->string('link_post')->nullable();
            $table->integer('number_days')->nullable();
            $table->string('budget')->nullable();
            $table->integer('number_click_expected')->nullable();
            $table->integer('number_click_reality')->nullable();
            $table->integer('number_impression')->nullable();
            $table->string('average_CPC')->nullable();
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
        Schema::dropIfExists('google_adword_media');
    }
}
