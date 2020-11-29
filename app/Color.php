<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['color', 'position', 'tournament_id'];

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }
}
