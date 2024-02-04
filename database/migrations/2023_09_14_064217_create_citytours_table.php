<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitytoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citytours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('singleLineDetail')->nullable(); // Make it nullable
            $table->string('howManyPeople')->nullable();
            $table->integer('totalDays')->nullable();
            $table->string('capacity')->nullable();
            $table->string('ageRestriction')->nullable();
            $table->string('image')->nullable();
            $table->integer('oldPrice')->nullable();
            $table->integer('newPrice')->nullable();
            $table->string('fromDate')->nullable();
            $table->string('time')->nullable();
            $table->string('promoCode')->nullable();
            $table->text('longDetail')->nullable(); // Make it nullable and use text data type
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
        Schema::dropIfExists('citytours');
    }
}
