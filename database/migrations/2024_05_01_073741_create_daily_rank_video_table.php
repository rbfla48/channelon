<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_rank_video', function (Blueprint $table) {
            $table->id();
            $table->string('type',10);//플랫폼명
            $table->string('channel',50);//채널명
            $table->string('channel_id',100);//채널ID
            $table->datetime('up_time');//업로드시간
            $table->string('thumbnail',255);//썸네일url
            $table->string('category',50);//카테고리
            $table->string('title',255);//영상제목
            $table->string('video_id',100);//영상ID
            $table->string('video_link',255);//영상링크
            $table->datetime('created_at');//수집시각
            $table->datetime('updated_at');//변경시각
            $table->index(['video_id', 'up_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_rank_video');
    }
};
