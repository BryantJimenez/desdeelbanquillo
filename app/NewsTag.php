<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
	protected $table = 'news_tag';

    protected $fillable = ['news_id', 'tag_id'];
}
