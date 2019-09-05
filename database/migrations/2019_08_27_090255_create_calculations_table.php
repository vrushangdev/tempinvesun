<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plant_size');
            $table->integer('basic');
            $table->integer('gst');
            $table->integer('total');
            $table->string('subsidy');
            $table->integer('subsidize_amount');
            $table->integer('net_payable');
            $table->integer('discom_charge');
            $table->integer('structure_modification');
            $table->integer('mobile_app');
            $table->integer('solar_monitoring');
            $table->integer('extended_aintenance');
            $table->integer('insurance_coverage');
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
        Schema::dropIfExists('calculations');
    }
}
