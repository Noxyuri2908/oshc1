<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->tinyInteger('role')->nullable()->default(0);
            $table->string('password');
            $table->string('authorization')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status');
            $table->rememberToken();
            $table->timestamps();
            $table->date('date_of_birth')->nullable();
            $table->string('admin_id')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->text('google_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
