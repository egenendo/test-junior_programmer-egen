<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTravel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_travel', function (Blueprint $table) {
            $table->char('id_travel')->primary();
            $table->string('travel_type');
            $table->string('request_name');
            $table->string('destination');
            $table->string('reason');
            $table->date('latter_date');
            $table->date('startdate_enddate');
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
        Schema::dropIfExists('table_travel');
    }
}
