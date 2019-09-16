<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'content', 'freelancer_id','offer_id','publish_status','status','type','released','deposit'
    ];

    protected $appends = ['link'];

    public function getDepositAttribute($val)
    {
        return intval($val);
    }

    public function getReleasedAttribute($val)
    {
        return intval($val);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class,'freelancer_id');
    }

    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }

    public function isExpired()
    {
        return $this->expires_at < now();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function removeThis()
    {
        $this->offers()->delete();
        $this->files()->delete();
        $this->conversations()->delete();
        $this->delete();
        return true;
    }

    public function scopeOpens($query)
    {
        return $query->where('publish_status','open')->where('confirmed_at','!=',null)->where('is_paid',true)->whereDate('expires_at','>',now())->latest();
    }

    public function link()
    {
        return route('user.project.view',['project'=>$this->id]);
    }

    public function getLinkAttribute()
    {
        return $this->link();
    }

    public function conversationLink(User $user=null)
    {
        return $this->isEmployer() && !is_null($user) ? route('conversations.etf',['project'=>$this->id,'user' => $user->id]) : route('conversations.fte',['project'=>$this->id]);
    }

    public function pubLink()
    {
        return url('/project/'.$this->id);
    }

    public function scopeDone($query)
    {
        return $query->where('publish_status',['closed','trust_done'])->latest();
    }

    public function getContentAttribute($val)
    {
        return strip_tags(str_replace("\n","<br>",$val),'<br>');
    }

    public function isEmployer(User $user=null)
    {
        return (optional($user)->id ?? user()->id) == $this->user->id;
    }

    public function isFreelancer(User $user=null)
    {
        return (optional($user)->id ?? user()->id) == $this->freelancer_id;
    }

    public function hasOffer(User $user = null)
    {
        return in_array(optional($user)->id ?? user()->id,$this->offers()->pluck('user_id')->toArray());
    }

    public function offer(User $user = null)
    {
        return $this->offers()->whereUserId(optional($user)->id ?? user()->id)->first();
    }

    public function finalOffer()
    {
        return $this->belongsTo(Offer::class,'offer_id')->first();
    }

    public function isFinalOffer(Offer $offer)
    {
        return $this->finalOffer()->id == $offer->id;
    }

    public function userSentMessages()
    {
        $result = collect();
        $vals = array_values($this->conversations()->latest()->pluck('user_id')->unique()->toArray());
        foreach ($vals as $val){
            $user = User::whereId($val)->first();
            if(!$this->isEmployer($user)){
                if(!$this->offer($user)){
                    $result->add($user);
                }
            }

        }
        return $result;
    }

    public function linkedIn()
    {
        $link = sprintf("https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=%s&source=Projestan",$this->pubLink(),sprintf("کسانی که میتونن پروژه %s برام انجام بدن پیشنهاد ارسال کنن !",$this->title),limit($this->content));
        return $link;
    }

    public function twitter()
    {
        $link = sprintf('http://twitter.com/share?text=کی می تونه این پروژه رو برام انجام بده؟&url=%s&hashtags=پروژه,فریلنس,پروژستان',$this->pubLink());
        return $link;
    }

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function isUserInvited(User $user=null)
    {
        return $this->invites()->where('user_id',optional($user)->id ?? user()->id)->count();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'project_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
