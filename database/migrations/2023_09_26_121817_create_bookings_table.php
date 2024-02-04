<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->integer('customer_phone');
            $table->enum('activity_type', ['CityTour','Attraction', 'Adventure']);
            $table->unsignedBigInteger('activity_id');
            $table->date('date');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->boolean('confirmed')->default(false); // Indicates whether the booking is confirmed
            $table->text('notes')->nullable(); // Additional notes or comments
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('activity_id')->references('id')->on('citytours')->on('attractions')->on('adventures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
