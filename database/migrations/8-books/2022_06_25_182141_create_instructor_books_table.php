<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_books', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('book_id');

            $table->foreign('instructor_id')
            ->on('instructors')
            ->references('id')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('book_id')
            ->on('books')
            ->references('id')
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
        Schema::dropIfExists('instructor_books');
    }
}
