<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('educational_stage_id');
            $table->unsignedBigInteger('educational_class_id');
            $table->unsignedBigInteger('subject_id');
            $table->boolean('isPublished')->default(0);
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
        Schema::dropIfExists('exams');
    }
}
