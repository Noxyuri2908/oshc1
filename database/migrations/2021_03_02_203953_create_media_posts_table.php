<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_place_id')->nullable();
            $table->integer('type_media_post');
            $table->date('schedule_post_date')->nullable();
            $table->date('created_post')->nullable();
            $table->string('category')->nullable();
            $table->string('post_title')->nullable();
            $table->string('post_link')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('source_post')->nullable();
            $table->integer('service_id')->nullable();
            $table->string('type_source')->nullable();
            $table->string('source_pr')->nullable();
            $table->integer('view')->default(0);
            $table->string('rate')->nullable();
            $table->date('post_date_fanpage')->nullable();
            $table->date('post_date_newletter')->nullable();
            $table->integer('seo')->nullable();
            $table->text('note')->nullable();
            $table->integer('react')->default(0);
            $table->integer('like')->default(0);
            $table->integer('share')->default(0);
            $table->integer('inbox')->default(0);
            $table->integer('budget_qc')->nullable();
            $table->string('tag')->nullable();
            $table->date('start_date_qc')->nullable();
            $table->integer('number_days')->default(0);
            $table->timestamps();
            $table->integer('group_id')->nullable();
            $table->string('credit_card', 255)->nullable();
            $table->string('total_budget', 255)->nullable();
            $table->string('source_detail')->nullable();
            $table->integer('category_email_marketing')->nullable();
            $table->integer('object_email_marketing')->nullable();
            $table->integer('number_of_selected_email_marketing')->nullable();
            $table->integer('number_of_clicked_link_email_marketing')->nullable();
            $table->integer('type_of_promotion_email_marketing')->nullable();
            $table->integer('number_of_agent_onshore_email_marketing')->nullable();
            $table->integer('number_of_agent_offshore_email_marketing')->nullable();
            $table->integer('number_of_promotion_email_marketing')->nullable();
            $table->double('amount_of_money_aud_email_marketing', 11, 2)->nullable();
            $table->string('amount_of_money_vnd_email_marketing', 255)->nullable();
            $table->string('total_amount_of_money_email_marketing', 255)->nullable();
            $table->text('note_email_marketing')->nullable();
            $table->tinyInteger('post_website')->nullable();
            $table->tinyInteger('post_fanpage')->nullable();
            $table->tinyInteger('post_email_marketing')->nullable();
            $table->tinyInteger('post_group')->nullable();
            $table->tinyInteger('is_hotnew')->nullable();
            $table->date('transfer_staff_date')->nullable();
            $table->bigInteger('translated_by')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('promote_date')->nullable();
            $table->integer('promotion_for')->nullable();
            $table->bigInteger('promotion_for_agent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_posts');
    }
}
