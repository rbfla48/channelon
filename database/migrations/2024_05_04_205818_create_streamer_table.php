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
        Schema::create('streamer', function (Blueprint $table) {
            $table->id();
            $table->string('platform',50);//플랫폼명
            $table->string('channel_name',50);//채널명
            $table->text('channel_thumbnail');//채널썸네일
            $table->string('channel_id',100);//채널id
            $table->datetime('created_at');//수집시각
            $table->datetime('updated_at');//변경시각
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streamer');
    }
};
