<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'slug', 'shield', 'tournament_id'];

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function matches() {
		return $this->belongsToMany(Match::class)->withPivot('goals')->withTimestamps();
	}
}
