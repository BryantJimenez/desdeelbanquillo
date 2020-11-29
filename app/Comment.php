<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'slug', 'state', 'news_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function news() {
        return $this->belongsTo(News::class);
    }
}
