<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('exam_student_id');
            $table->unsignedBigInteger('exam_question_id');
            $table->text('correct_answer');
            $table->string('question_score');
            $table->string('user_score');
            $table->boolean('isAnswerCorrect')->nullable()->default(0);

            $table->foreign('exam_student_id')
            ->references('id')
            ->on('exam_students')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('exam_question_id')
            ->references('id')
            ->on('exam_questions')
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
        Schema::dropIfExists('survey_answers');
    }
}
