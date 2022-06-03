<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMediaPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_media_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id')->nullable();
            $table->integer('type_content_id')->nullable();
            $table->string('category', 255)->nullable();
            $table->date('post_date')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_media_posts');
    }
}
