<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('group_name')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assign_by')->nullable();
            $table->text('assign_by_group')->nullable();
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
        Schema::dropIfExists('check_list_groups');
    }
}
