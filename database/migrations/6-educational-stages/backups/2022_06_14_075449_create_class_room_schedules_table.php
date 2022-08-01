<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_schedule', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('educational_class_term_id');
            $table->unsignedBigInteger('class_room_id');
            $table->date('schedule_date');
            $table->string('slug');

            $table->foreign('educational_class_term_id')
            ->references('id')
            ->on('educational_class_terms')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('class_room_id')
            ->references('id')
            ->on('class_rooms')
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
        Schema::dropIfExists('class_room_schedules');
    }
}
