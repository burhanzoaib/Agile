<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivityColumnsToBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('activity_type', ['CityTour', 'Attraction', 'Adventure', 'Viptransportation']);
            $table->unsignedBigInteger('activity_id');
            // $table->foreign('activity_id')->references('id')->on('citytours')->on('attractions')->on('adventures')->on('viptransportations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
