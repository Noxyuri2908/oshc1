<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id')->nullable();
            $table->integer('website_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('person_id')->nullable();
            $table->text('problem')->nullable();
            $table->date('date_of_suggestion')->nullable();
            $table->text('solution_text')->nullable();
            $table->integer('level_of_process')->nullable();
            $table->integer('result_id')->nullable();
            $table->date('processing_time')->nullable();
            $table->text('budget')->nullable();
            $table->date('checklist_created_at')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->timestamps();
            $table->integer('type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_lists');
    }
}
