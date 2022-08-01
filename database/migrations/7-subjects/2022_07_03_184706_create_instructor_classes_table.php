<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_classes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('term_id')->nullable();
            $table->unsignedBigInteger('educational_class_id');
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->unsignedBigInteger('subject_id');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('term_id')
            ->references('id')
            ->on('terms')
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

            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects')
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
        Schema::dropIfExists('instructor_classes');
    }
}
