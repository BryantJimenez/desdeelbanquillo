<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['slug', 'day', 'state', 'tournament_id'];

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }

    public function matches() {
        return $this->hasMany(Match::class);
    }
}
