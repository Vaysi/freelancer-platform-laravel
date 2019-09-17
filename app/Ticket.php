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

    public function second()
    {
        return $this->belongsTo(User::class,'target_id');
    }

    public function judge()
    {
        return $this->belongsTo(User::class,'judge_id');
    }
}
