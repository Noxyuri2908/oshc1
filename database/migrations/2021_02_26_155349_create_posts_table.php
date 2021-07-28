<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('image');
            $table->text('des_s');
            $table->text('content');
            $table->text('des_s_cn');
            $table->text('des_s_vi');
            $table->text('content_cn');
            $table->text('content_vi');
            $table->string('name_cn', 255);
            $table->string('name_vi', 255);
            $table->integer('cat_id')->nullable();
            $table->text('tags')->nullable();
            $table->integer('number_click')->nullable();
            $table->integer('type')->nullable();
            $table->string('meta_des')->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_title')->nullable();
            $table->integer('created_by');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->date('post_created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
