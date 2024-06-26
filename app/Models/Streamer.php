<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streamer extends Model
{
    use HasFactory;

    protected $table = 'streamer';

    protected $fillable = [
                            'platform',
                            'channel_name',
                            'channel_thumbnail',
                            'channel_id'
    ];
}
