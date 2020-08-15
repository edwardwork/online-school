<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroductionVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introduction_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->comment('ID of parent category');
            $table->string('title')->comment('Title for video');
            $table->integer('video_id')->comment('ID video in vimeo.com');
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
        Schema::dropIfExists('introduction_videos');
    }
}
