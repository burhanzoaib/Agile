<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVipTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viptransportations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('singleLineDetail')->nullable(); // Make it nullable
            $table->string('howManyPeople')->nullable();
            $table->string('totalDays')->nullable();
            $table->string('capacity')->nullable();
            $table->string('ageRestriction')->nullable();
            $table->json('images')->nullable();
            $table->string('oldPrice')->nullable();
            $table->string('newPrice')->nullable();
            $table->string('fromDate')->nullable();
            $table->string('promoCode')->nullable();
            $table->text('longDetail')->nullable(); 
            $table->text('highlights')->nullable();
            $table->text('full_decription')->nullable();
            $table->text('includes')->nullable();
            $table->text('not_suitable')->nullable();
            $table->text('meeting_point')->nullable();
            $table->text('important_information')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('vip_transportations');
    }
}
