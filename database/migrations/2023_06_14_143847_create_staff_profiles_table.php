<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_profiles', function (Blueprint $table) {
            $table->id();
            $table->String('Name');
            $table->String('Father_Name');
            $table->String('NRC');
            $table->date('DOB');
            $table->string('EDUCATION');
            $table->string('WORK_DEP');
            $table->string('WORK_POSITION');
            $table->integer('BASIC_SALARY');
            $table->integer('DEBT');
            $table->text('ADDRESS');
            $table->string('PHOTO_NAME');
            $table->boolean('STATUS');
            $table->date('START_WORKING_DATE');
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
        Schema::dropIfExists('staff_profiles');
    }
}
