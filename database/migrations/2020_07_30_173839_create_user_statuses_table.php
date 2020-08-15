<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('lesson_id');
            $table->text('question_ids');
            $table->integer('current_position');
            $table->integer('count_true_answers')->default(0);
            $table->integer('attempt')->default(0);
            $table->integer('max_attempt')->default(3);
            $table->integer('threshold')->default(80);
            $table->integer('max_duration')->default(0);
            $table->integer('current_duration')->default(0);
            $table->boolean('is_success')->default(false);
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
        Schema::dropIfExists('user_statuses');
    }
}
