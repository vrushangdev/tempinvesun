<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyDataSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy_data_sets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('monthly_bill')->nullable();
            $table->double('plan_size')->nullable();
            $table->double('energy_generation')->nullable();
            $table->double('monthly_energy_saving')->nullable();
            $table->double('payback_period')->nullable();
            $table->double('free_energy_generation')->nullable();
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
        Schema::dropIfExists('energy_data_sets');
    }
}
