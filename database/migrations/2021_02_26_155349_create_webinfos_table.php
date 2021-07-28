<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->string('name_cn', 255)->nullable();
            $table->string('name_vi', 255)->nullable();
            $table->text('content_cn')->nullable();
            $table->text('content_vi')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('webinfos');
    }
}
