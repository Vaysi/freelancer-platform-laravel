<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'user_id',
        'target_id',
        'project_id',
        'content',
        'read'
    ];
    protected $appends = ['ago','countUnread','countUnreadAuthor'];
    public function getAgoAttribute()
    {
        return jdate($this->created_at)->ago();
    }

    protected $with = ['sender', 'receiver','project'];

    public function scopeBySender($q, $sender)
    {
        $q->where('user_id', $sender);
    }

    public function scopeByReceiver($q, $sender)
    {
        $q->where('target_id', $sender);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name','avatar']);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'target_id')->select(['id', 'name','avatar']);
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id')->select(['id','title']);
    }

    public function getCountUnreadAttribute()
    {
        return user()->chatMessages()->where('read',0)->count();
    }

    public function getCountUnreadAuthorAttribute()
    {
        return user()->chatMessages()->where('read',0)->where('user_id',$this->user_id)->count();
    }
}
