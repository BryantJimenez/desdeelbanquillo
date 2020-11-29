<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['slug', 'date', 'state', 'stadium_id', 'day_id'];

    public function day() {
        return $this->belongsTo(Day::class);
    }

    public function stadium() {
        return $this->belongsTo(Stadium::class);
    }

    public function teams() {
		return $this->belongsToMany(Team::class)->withPivot('goals')->withTimestamps();
	}

    public function players() {
        return $this->belongsToMany(Player::class)->withTimestamps();
    }
}
