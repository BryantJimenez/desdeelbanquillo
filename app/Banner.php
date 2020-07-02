<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'slug', 'type', 'image', 'pre_url', 'url', 'state', 'target'];
}
