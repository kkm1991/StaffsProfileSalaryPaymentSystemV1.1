<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('basicSalary');
            $table->integer('rareCost');
            $table->integer('bonus');
            $table->integer('attendedBonus');
            $table->integer('busFee');
            $table->integer('First_Total');

            $table->integer('mealDeduct');
            $table->integer('absence');
            $table->integer('ssbFee');
            $table->integer('fine');
            $table->integer('redeem');
            $table->string('otherDeductLable');
            $table->integer('otherDeduct');
            $table->integer('staff_id');
            $table->integer('reservation_id');
            $table->integer('dep');
            $table->integer('Final_Total');

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
        Schema::dropIfExists('salaries');
    }
}
