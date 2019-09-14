<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreelancerController extends Controller
{
    public function index()
    {
        $offers = user()->offers()->latest()->paginate(25);
        return view('User.Freelancer.index',compact('offers'));
    }

    public function judge()
    {
        return view('User.Freelancer.judge');
    }
}
