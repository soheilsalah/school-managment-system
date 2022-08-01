<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalClassTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_class_terms', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('educational_class_id');
            $table->unsignedBigInteger('term_id');
            $table->date('start_at');
            $table->date('end_at');

            $table->foreign('educational_class_id')
            ->references('id')
            ->on('educational_classes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('term_id')
            ->references('id')
            ->on('terms')
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
        Schema::dropIfExists('educational_class_terms');
    }
}
