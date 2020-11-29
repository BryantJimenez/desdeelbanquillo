<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchTeam extends Model
{
    protected $table = 'match_team';

    protected $fillable = ['goals', 'match_id', 'team_id'];
}
