<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['facebook', 'instagram', 'twitter', 'email_one', 'email_two', 'pre_url', 'listen', 'brands'];
}
