<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('regional', 255);
            $table->integer('outlet');
            $table->string('add_road', 255);
            $table->string('add_village', 255);
            $table->string('add_subdistrict', 255);
            $table->string('add_regency', 255);
            $table->string('add_provice', 255);
            $table->string('add_postalcode', 5);
            $table->string('email', 50);
            $table->string('phone', 20);
            $table->string('lic_number', 100);
            $table->date('lic_date')->nullable();
            $table->string('tax_number', 50);
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
        Schema::dropIfExists('companies');
    }
}
