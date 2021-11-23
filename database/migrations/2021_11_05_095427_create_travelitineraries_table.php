<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelitinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelitineraries', function (Blueprint $table) {
            $table->id();
            $table->string('ti_nr', 20);
            $table->date('date_start');
            $table->date('date_end');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade');
            $table->foreignId('car_id')->constrained('cars')->onUpdate('cascade');
            $table->unsignedInteger('odo_start');
            $table->unsignedInteger('odo_end');
            $table->unsignedInteger('total_distance_km');
            $table->decimal('fuel_cons_factory', $precision = 2, $scale = 2)->nullable();
            $table->double('fuel_average', 2, 2)->nullable();
            $table->unsignedInteger('distance_business')->nullable();
            $table->unsignedInteger('distance_private')->nullable();
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
        Schema::dropIfExists('travelitineraries');
    }
}
