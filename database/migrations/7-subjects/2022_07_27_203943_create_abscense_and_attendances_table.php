<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbscenseAndAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abscense_and_attendances', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('schedule_session_id');
            $table->unsignedBigInteger('student_id');
            $table->boolean('hasJoined')->nullable();
            $table->dateTime('joined_at')->nullable();
            $table->boolean('hasLeft')->nullable();
            $table->dateTime('left_at')->nullable();
            $table->boolean('endedByHost')->default(0)->nullable();

            $table->foreign('schedule_session_id')
            ->references('id')
            ->on('schedule_sessions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('abscense_and_attendances');
    }
}
