<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }


}
