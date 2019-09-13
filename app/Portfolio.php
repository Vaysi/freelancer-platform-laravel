<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    protected $casts = ['images'=>'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }

    public function withoutThumb()
    {
        $images = $this->images;
        array_shift($images);
        return $images;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id',user()->id)->count();
    }

    public function isTheCreator()
    {
        return $this->user->id == user()->id;
    }
}
