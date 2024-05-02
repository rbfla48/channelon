<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRankVideo extends Model
{
    use HasFactory;

    protected $table = 'daily_rank_video';

    protected $fillable = [
                            'type',
                            'channel',
                            'channel_id',
                            'up_time',
                            'thumbnail',
                            'category',
                            'title',
                            'video_id',
                            'video_link'
                        ];
}
