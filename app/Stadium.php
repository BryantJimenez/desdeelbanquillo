<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
	protected $table = 'stadiums';

    protected $fillable = ['name', 'slug'];

    public function matches() {
        return $this->hasMany(Match::class);
    }
}
