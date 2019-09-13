<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->first();
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
