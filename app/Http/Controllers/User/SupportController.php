<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index()
    {
        return view('User.Support.index');
    }

    public function contact()
    {
        return view('User.Support.contact');
    }
}
