<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFuelConsFactoryToTotalFuelLInTravelitinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travelitineraries', function (Blueprint $table) {
            $table->renameColumn('fuel_cons_factory', 'total_fuel_l');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travelitineraries', function (Blueprint $table) {
            $table->renameColumn('fuel_cons_factory', 'total_fuel_l');
        });
    }
}
