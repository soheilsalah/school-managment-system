<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('educational_stage_id');
            $table->unsignedBigInteger('educational_class_id');
            $table->unsignedBigInteger('class_room_id')->nullable();

            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('educational_stage_id')
            ->references('id')
            ->on('educational_stages')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('educational_class_id')
            ->references('id')
            ->on('educational_classes')
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
        Schema::dropIfExists('student_classes');
    }
}
