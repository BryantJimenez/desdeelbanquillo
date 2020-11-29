<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['title', 'slug', 'year', 'day', 'position'];

    public function teams() {
        return $this->hasMany(Team::class);
    }

    public function days() {
        return $this->hasMany(Day::class);
    }

    public function colors() {
        return $this->hasMany(Color::class);
    }
}
