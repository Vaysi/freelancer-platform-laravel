<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsTo(User::class,'target_id');
    }

    public function judge()
    {
        return $this->belongsTo(User::class,'judge_id');
    }

    public function authorize(User $user=null)
    {
        $user = $user ?? auth()->user();
        $pass = 0;
        if($this->user_id == $user->id || $this->target_id == $user->id || $this->judge_id == $user->id || $user->admin){
            $pass = 1;
        }
        return $pass;
    }

    public function link()
    {
        return route('support.view',$this->id);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function isFromMe()
    {
        return $this->user_id == user()->id ? 'me' : 'him';
    }
}
