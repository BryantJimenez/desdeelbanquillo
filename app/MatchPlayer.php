<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
    protected $table = 'match_player';

    protected $fillable = ['match_id', 'player_id'];
}
