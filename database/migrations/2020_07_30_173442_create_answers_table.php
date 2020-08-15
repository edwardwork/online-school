<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->comment('Relation with question');
            $table->text('text')->comment('Text of answer');
            $table->boolean('is_true')->default(false)->comment('Indicate if this answer is true');
            $table->integer('order_number')->default(0)->comment('Order number in answer, if 0 - order do not important');
            $table->string('image_url')->nullable()->comment('URL to image');
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
        Schema::dropIfExists('answer');
    }
}
