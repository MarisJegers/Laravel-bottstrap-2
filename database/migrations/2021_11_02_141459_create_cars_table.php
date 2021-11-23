<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('reg_nr', 10);
            $table->string('make', 20);
            $table->string('model', 20)->nullable();
            $table->string('fuel_type', 15);
            $table->integer('prod_year')->nullable();
            $table->decimal('fuel_cons_factory', $precision = 2, $scale = 1)->nullable();
            $table->date('purchase_date')->nullable();
            $table->foreignId('cc_number_id')->nullable()->constrained('costcenters')->onUpdate('cascade');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
