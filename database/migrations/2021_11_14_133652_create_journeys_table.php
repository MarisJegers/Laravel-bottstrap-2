<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ti_nr_id')->constrained('travelitineraries')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->string('position_start');
            $table->string('position_end');
            $table->text('trip_target')->nullable();
            $table->unsignedInteger('distance_km');
            $table->foreignId('cc_number_id')->nullable()->constrained('costcenters')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('type_private')->nullable();
            $table->boolean('type_business')->nullable();
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
        Schema::dropIfExists('journeys');
    }
}
