<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        $model_name = ucfirst($this->model);
        $model = app("App\Model\{$model_name}");
        return $model->where('id', $this->model_id)->first();
    }
}
