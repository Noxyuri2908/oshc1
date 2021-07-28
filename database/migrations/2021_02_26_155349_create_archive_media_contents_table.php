<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveMediaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_media_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('website_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->nullable();
            $table->string('link')->nullable();
            $table->date('date')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('archive_media_contents');
    }
}
