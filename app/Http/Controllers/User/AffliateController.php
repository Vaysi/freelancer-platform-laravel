<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AffliateController extends Controller
{
    public function index()
    {
        return view('User.Affiliate.index');
    }

    public function banner()
    {
        return view('User.Affiliate.banner');
    }
}
