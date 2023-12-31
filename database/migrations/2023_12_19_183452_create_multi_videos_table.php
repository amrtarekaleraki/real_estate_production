<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('multi_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('building_id');
            $table->string('video_name');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('multi_videos');
    }
};
