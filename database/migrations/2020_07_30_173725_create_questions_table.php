<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->comment('Relation with lesson');
            $table->text('text')->comment('Text of question');
            $table->integer('type')->default(1)
                ->comment('1 - expected only one answer, 
                                    2 - expected one or more answers, 
                                    3 - expected answers that ordered');
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
        Schema::dropIfExists('questions');
    }
}
