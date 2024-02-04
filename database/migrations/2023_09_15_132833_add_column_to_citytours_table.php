<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCitytoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('citytours', function (Blueprint $table) {
            $table->text('highlights');
            $table->text('full_decription');
            $table->text('includes');
            $table->text('not_suitable');
            $table->text('meeting_point');
            $table->text('important_information');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('citytours', function (Blueprint $table) {
            //
        });
    }
}
