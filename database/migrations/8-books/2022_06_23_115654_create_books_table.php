<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('book_category_id');
            $table->string('name');
            $table->text('description');
            $table->string('pdf');
            $table->string('thumbnail');
            $table->string('number_of_pages');
            $table->string('author');
            $table->string('isbn');
            $table->boolean('isFree');
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('price_after_discount')->nullable();
            $table->boolean('isPublished')->nullable()->default(0);
            $table->string('slug');

            $table->foreign('book_category_id')
            ->on('book_categories')
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
        Schema::dropIfExists('books');
    }
}
