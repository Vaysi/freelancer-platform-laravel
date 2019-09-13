<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->first();
    }

    public function skillable()
    {
        return $this->morphTo();
    }

    public function project()
    {
        return $this->morphedByMany(Project::class,'skills');
    }

    public function link()
    {
        return url('user/dashboard/'.$this->id);
    }
}
