<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveMediaLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_media_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->integer('form_id')->nullable();
            $table->string('country_id')->nullable();
            $table->integer('source_id')->nullable();
            $table->string('link')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('is_hot_new')->nullable();
            $table->integer('information_focused_id')->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('admin', 255)->nullable();
            $table->string('email_admin', 255)->nullable();
            $table->string('telephone', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_media_links');
    }
}
