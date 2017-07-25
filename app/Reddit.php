<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reddit extends Model
{
    protected $fillable = ['subreddit', 'selftext', 'reddit_id', 'image_url', 'nsfw', 'ups', 'permalink', 'title'];
}
