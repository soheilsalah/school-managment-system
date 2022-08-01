<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subscriptions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('educational_class_subscription_id');
            $table->unsignedBigInteger('student_id');
            $table->string('subscription_plan');
            $table->string('payment_amount');
            $table->date('subscription_date_start');
            $table->date('subscription_date_end');
            $table->string('slug');

            $table->foreign('educational_class_subscription_id')
            ->references('id')
            ->on('educational_class_subscriptions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('student_id')
            ->references('id')
            ->on('students')
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
        Schema::dropIfExists('student_subscriptions');
    }
}
