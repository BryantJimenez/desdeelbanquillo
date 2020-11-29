<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'featured', 'category_id', 'state'];

    public function category() {
        return $this->belongsTo(CategoryGallery::class);
    }
}
