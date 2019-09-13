<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){
        if($request->ref){
            cookie('ref',intval($request->ref),60);
        }
        return view('Front.index');
    }
}
