<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'slug', 'prefix'];

    public function players() {
        return $this->hasMany(Player::class);
    }
}
