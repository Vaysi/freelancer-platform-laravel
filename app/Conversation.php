<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function isFromMe()
    {
        return $this->user_id == user()->id ? 'me' : 'him';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function to()
    {
        return $this->belongsTo(User::class,'target_id');
    }

    public function getMessageAttribute($val)
    {
        return strip_tags(str_replace("\n","<br>",$val),"<br>");
    }

    public function scopeUs($query,Project $project,User $user=null)
    {
        return $query->where(function ($q) use ($project,$user){
            $q->where('user_id',$project->user_id)->where('target_id',optional($user)->id ?? user()->id);
        })->orWhere(function ($q) use ($project,$user) {
            $q->where('target_id',$project->user->id)->where('user_id',optional($user)->id ?? user()->id);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
