<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','name','email','balance','phone','nickname','parent_id'
    ];

    protected $appends = ['nicky'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'expires_at' => 'datetime'
    ];


    public function getAdminAttribute($val)
    {
        return boolval($val);
    }

    public function getAvatarAttribute($val)
    {
        return asset('avatars/'.$val);
    }

    public function getBalanceAttribute($val)
    {
        return intval($val);
    }

    public function isExpired()
    {
        return $this->expires_at < now();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function successfulProjects()
    {
        return $this->projects()->where('status','closed')->count();
    }

    public function openProjects()
    {
        return $this->projects()->where('status','open')->where('publish_status','open');
    }

    public function allProjects()
    {
        return $this->projects()->where('is_paid',true)->count();
    }

    public function allProjectsCanShow()
    {
        return $this->projects()->where('is_paid',true)->whereNotIn('status',['open','pending','draft']);
    }

    public function doneProjects()
    {
        return $this->projects()->where('is_paid',true)->whereIn('publish_status',['closed','ended'])->count();
    }

    public function confirmedProjects()
    {
        return $this->projects()->where('is_paid',true)->where('confirmed_at','!=',null)->count();
    }

    public function withOffers()
    {
        return $this->projects()->where('is_paid',true)->where('offer_id','!=',null)->count();
    }

    public function jobs()
    {
        return $this->hasMany(Project::class,'freelancer_id');
    }

    public function allJobs()
    {
        return $this->jobs()->count();
    }

    public function doneJobs()
    {
        return $this->jobs()->whereIn('status',['closed','ended'])->count();
    }

    public function currentJobs()
    {
        return $this->jobs()->whereNotIn('status',['closed','ended'])->count();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }

    public function name()
    {
        return is_null($this->nickname) ? "کاربر {$this->id}" : $this->nickname;
    }

    public function getNickyAttribute()
    {
        return $this->name();
    }

    public function resumeLink()
    {
        return route('resume.view',['user'=>$this->id]);
    }

    public function isMe(User $user=null)
    {
        return optional($user)->id ?? $this->id == user()->id;
    }

    public function offer(Project $project)
    {
        return $this->offers()->whereProjectId($project->id)->first();
    }

    public function messages()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadMessages()
    {
        return $this->hasMany(Notification::class)->where('read',0);
    }

    public function balance($price,$operator=null,$value=null)
    {
        if(is_null($operator)){
            if(is_null($value)){
                if($this->balance >= intval($price)){
                    return true;
                }else {
                    return false;
                }
            }elseif($value) {
                $this->update(['balance' => intval($price)]);
            }
        }else {
            $price = intval($price);
            if($operator == '-'){
                $this->update([
                    'balance' => $this->balance - $price
                ]);
            }elseif($operator == '+'){
                $this->update([
                    'balance' => $this->balance + $price
                ]);
            }
        }
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class)->with(['user','project','to'])->latest()->get()->merge($this->hasMany(Conversation::class,'target_id')->with(['user','project','to'])->latest()->get());
    }

    public function lastConversations($cond=false)
    {
        if($cond){
            return $this->conversations()->unique(['project_id','user_id','target_id']);
        }else {
            return $this->conversations()->unique('project_id');
        }
    }

    public function unreadConversations()
    {
        return Conversation::where('read',0)->where('status','confirmed')->where('target_id',user()->id)->count();
    }

    public function unreadConversationsIds()
    {
        $c = Conversation::select(['user_id','project_id'])->where('read',0)->where('status','confirmed')->where('target_id',user()->id)->get();
        $r = [];
        foreach ($c as $i){
            $r[$i->project_id] = $i->user_id;
        }
        return $r;
    }
    public function unreadConversationsIds2()
    {
        return Conversation::where('read',0)->where('status','confirmed')->where('target_id',user()->id)->pluck('project_id')->toArray();
    }

    public function unreadProjects()
    {
        return Project::where('status','open')->where('publish_status','open')->whereBetween('created_at',[user()->checked_at,now()])->whereHas('skills', function (Builder $query) {
            $query->whereIn('skill_id',array_values(auth()->user()->skills()->pluck('skill_id')->toArray()));
        })->count();
    }

    public function loginHistory()
    {
        return $this->hasMany(Login::class)->latest();
    }

    public function myPackage(){
        $return = $this->belongsTo(Package::class,'package_id');
        return $this->isExpired() ? false : $return;
    }

    public function package()
    {
        if(!is_bool($this->myPackage()) && $this->myPackage()->count()){
            return $this->myPackage()->first();
        }else{
            $package = Package::where('is_default',true)->latest()->first();
            return $package;
        }
    }

    public function chatMessages()
    {
        return $this->hasMany(Message::class, 'target_id');
    }

    public function hasIncommon($user_id,$project_id)
    {
        $target = User::find(intval($user_id))->first();
        $project = Project::find(intval($project_id))->first();
        if($project->hasOffer($target->id) || $project->user()->id == $target->id){
            return true;
        }else {
            return false;
        }
    }

    public function unreadMessage()
    {
        return $this->chatMessages()->where('read',0)->count();
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function phone()
    {
        if($this->phone_verified_at && $this->phone){
            return $this->phone;
        }else {
            return false;
        }
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function references()
    {
        return $this->hasMany(User::class,'parent_id');
    }

    public function inviter()
    {
        return $this->belongsTo(User::class,'parent_id');
    }

    public function refLink()
    {
        return url('?ref='.user()->id);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class)->where('type','support');
    }

    public function judges()
    {
        return $this->hasMany(Ticket::class)->where('type','judgement');
    }
}
