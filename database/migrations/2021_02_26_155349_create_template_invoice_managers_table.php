<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateInvoiceManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_invoice_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('template_name')->nullable();
            $table->text('extended_properties')->nullable();
            $table->string('company_address')->nullable();
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->text('content')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_phone')->nullable();
            $table->timestamps();
            $table->string('company_email', 255)->nullable();
            $table->string('company_name_vi', 255)->nullable();
            $table->string('company_address_vi_1', 255)->nullable();
            $table->string('company_phone_vi_1', 255)->nullable();
            $table->string('company_address_vi_2', 255)->nullable();
            $table->string('company_phone_vi_2', 255)->nullable();
            $table->string('company_email_vi', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_invoice_managers');
    }
}
