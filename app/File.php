<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function(File $file) {
            Storage::disk('upload')->delete($file->url);
            $file->delete();
        });
    }

    public function link()
    {
        return route('download',['id'=>encrypt($this->id)]);
    }
}
