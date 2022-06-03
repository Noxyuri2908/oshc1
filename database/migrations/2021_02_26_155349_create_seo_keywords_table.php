<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('destination_target')->nullable();
            $table->string('keyword')->nullable();
            $table->string('relevant_info')->nullable();
            $table->string('gg_ad')->nullable();
            $table->integer('ranking')->nullable();
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('seo_keywords');
    }
}
