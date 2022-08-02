<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_workout', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedBigInteger('workout_id');

            $table->foreign('athlete_id')
                ->references('id')
                ->on('athletes')
                ->onDelete('cascade');

            $table->foreign('workout_id')
                ->references('id')
                ->on('workouts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete_workout');
    }
}
