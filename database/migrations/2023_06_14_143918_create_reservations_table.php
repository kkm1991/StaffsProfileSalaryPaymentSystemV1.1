<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('rareCost');
            $table->integer('bonus');
            $table->integer('attendedBonus');
            $table->integer('busFee');
            $table->integer('mealDeduct');
            $table->integer('absence');
            $table->integer('ssbFee');
            $table->integer('fine');
            $table->integer('redeem');
            $table->string('otherDeductLable');
            $table->integer('otherDeduct');
            $table->integer('staff_id');
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
        Schema::dropIfExists('reservations');
    }
}
