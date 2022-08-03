<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('educational_stage_id');
            $table->unsignedBigInteger('educational_class_id');
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('homework')->nullable();
            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->dateTime('end_at');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->string('password')->nullable()->comment('meeting password');
            $table->text('start_url');
            $table->text('join_url');
            $table->string('price');
            $table->boolean('isStarted')->default(0)->nullable();
            $table->boolean('isEnded')->default(0)->nullable();
            $table->string('created_by')->default('admin');
            $table->string('ended_by')->default('admin');
            $table->boolean('isWithdrawn')->nullable();
            $table->date('withdrawn_at')->nullable();
            $table->string('slug');

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

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
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
        Schema::dropIfExists('schedule_sessions');
    }
}
