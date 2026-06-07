<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }



    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }


}

