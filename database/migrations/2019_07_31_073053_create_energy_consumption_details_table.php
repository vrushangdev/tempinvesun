<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyConsumptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy_consumption_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('disribution_company_id');
            $table->integer('service_number');
            $table->integer('category_id');
            $table->integer('supply_type_id');
            $table->double('section_load',10,2);
            $table->double('contract_demand',10,2);
            $table->double('billing_demand',10,2);
            $table->double('avg_power_factor',10,2);
            $table->string('energy_bill_front');
            $table->string('energy_bill_back');
            $table->double('total_amount',10,2);
            $table->double('unit_consumed',10,2);
            $table->double('unit_rate',10,2);
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
        Schema::dropIfExists('energy_consumption_details');
    }
}
