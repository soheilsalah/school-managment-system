<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_role_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('expense_role_id');
            $table->boolean('canRead')->nullable()->default(1);
            $table->boolean('canCreate')->nullable();
            $table->boolean('canUpdate')->nullable();
            $table->boolean('canDelete')->nullable();

            $table->foreign('expense_role_id')
            ->on('expense_roles')
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
        Schema::dropIfExists('expense_role_permissions');
    }
}
