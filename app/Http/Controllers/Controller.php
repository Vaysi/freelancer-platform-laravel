<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadFile(Request $request,$key,$path,$resize=null,$height=null) {
        $file = $request->file($key);
        $name = md5(md5($file->getClientOriginalName() . time())) . "." . $file->getClientOriginalExtension();
        if($resize){
            Image::make($file->getRealPath())->fit($resize,$height)->save("$path/$name",80);
        }else {
            $file->move($path,$name);
        }
        return $name;
    }
}
