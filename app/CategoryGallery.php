<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGallery extends Model
{
	protected $table = 'category_gallery';

    protected $fillable = ['name', 'slug'];

    public function galleries() {
        return $this->hasMany(Gallery::class, 'category_id');
    }
}
