<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'slug', 'photo', 'number', 'position_id', 'team_id'];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function matches() {
		return $this->belongsToMany(Match::class)->withTimestamps();
	}
}
