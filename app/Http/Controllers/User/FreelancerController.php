<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreelancerController extends Controller
{
    public function index()
    {
        return view('User.Freelancer.index');
    }

    public function judge()
    {
        return view('User.Freelancer.judge');
    }
}
