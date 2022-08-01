<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('class_room_schedule_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->time('start_at');
            $table->time('end_at');
            $table->string('price');
            $table->string('slug');

            $table->foreign('class_room_schedule_id')
            ->references('id')
            ->on('class_room_schedule')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
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
        Schema::dropIfExists('class_room_sessions');
    }
}
