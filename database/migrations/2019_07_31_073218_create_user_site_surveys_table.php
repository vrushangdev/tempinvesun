<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSiteSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_site_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('roof_length');
            $table->string('roof_image_one');
            $table->string('roof_image_two');
            $table->string('area');
            $table->string('rows');
            $table->string('column');
            $table->string('panel_orientation');
            $table->string('direction');
            $table->string('structure_selection');
            $table->string('dc_wiring');
            $table->string('dc_db_location');
            $table->string('inverter_location');
            $table->string('ac_wiring_connection');
            $table->string('meter_location');
            $table->string('building_overview');
            $table->string('building_north');
            $table->string('building_east');
            $table->string('building_west');
            $table->integer('access_of_roof');
            $table->integer('access_of_house');
            $table->integer('site_condition');
            $table->integer('shadding');
            $table->integer('age_of_roof');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('user_site_surveys');
    }
}
