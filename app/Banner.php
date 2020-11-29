<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'slug', 'featured', 'image', 'pre_url', 'url', 'state', 'target', 'type'];
}
