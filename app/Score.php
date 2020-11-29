<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['time', 'name', 'score_one', 'score_two', 'team_one', 'team_two', 'tournament'];
}
