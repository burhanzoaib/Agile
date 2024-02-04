<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_data', function (Blueprint $table) {
            $table->id();
            $table->integer('travelorId');
            $table->integer('flightId');
            $table->string('originLocation');
            $table->string('originDestination');
            $table->string('email');
            $table->decimal('totalPrice');
            $table->string('date');
            $table->string('noOfTravelers');
            $table->string('departureDate');
            $table->string('departureTerminal');
            $table->string('arrivalDate');
            $table->string('arrivalTerminal');
            $table->string('carrierCode');
            $table->string('flightNumber');
            $table->integer('adultId');
            $table->integer('childrenId');
            $table->integer('infantsId');
            $table->integer('associatedAdultId');
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
        Schema::dropIfExists('flight_data');
    }
}
