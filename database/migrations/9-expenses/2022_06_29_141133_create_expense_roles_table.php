<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('financial_id');
            $table->unsignedBigInteger('expense_id');

            $table->foreign('financial_id')
            ->on('financials')
            ->references('id')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('expense_id')
            ->on('expenses')
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
        Schema::dropIfExists('expense_roles');
    }
}
