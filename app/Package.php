<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected  $guarded = [];
    protected $appends = ['color','colorSecond'];

    public function getPriceAttribute($val)
    {
        return intval($val);
    }

    public function getColorAttribute()
    {
        if(Str::contains($this->icon,'free.png')){
            return 'blue';
        }elseif(Str::contains($this->icon,'bronze.png')){
            return 'bronze';
        }elseif(Str::contains($this->icon,'gold.png')){
            return 'gold';
        }else{
            return 'silver';
        }
    }

    public function getColorSecondAttribute()
    {
        if(Str::contains($this->icon,'free.png')){
            return 'info';
        }elseif(Str::contains($this->icon,'bronze.png')){
            return 'warning';
        }elseif(Str::contains($this->icon,'gold.png')){
            return 'danger';
        }else{
            return 'secondary';
        }
    }

    public function getFeaturesAttribute($val){
        return json_decode($val);
    }

    public function getIconAttribute($val){
        return asset('images/plan/'.$val);
    }

    protected $casts = [
        'features' => 'array',
    ];
}
