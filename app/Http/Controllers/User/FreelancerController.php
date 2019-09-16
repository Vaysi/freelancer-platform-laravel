<?php

namespace App\Http\Controllers\User;

use App\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreelancerController extends Controller
{
    public function index()
    {
        $offers = user()->offers()->latest()->paginate(25);
        return view('User.Freelancer.index',compact('offers'));
    }

    public function filter(Request $request)
    {
        if(!$request->has('status') || $request->status == 'all'){
            $offers = user()->offers()->latest()->paginate(25);
        }elseif($request->status == 'accepted'){
            $offers = user()->offers()->whereHas('project',function ($query){
                $query->where('status','closed')->where('freelancer_id',user()->id);
            })->latest()->paginate(25);
        }elseif($request->status == 'working'){
            $offers = user()->offers()->whereHas('project',function ($query){
                $query->where('status',['emp_trust','flc_trust','trust_done','flc_done'])->where('freelancer_id',user()->id);
            })->latest()->paginate(25);
        }elseif($request->status == 'open'){
            $offers = user()->offers()->whereHas('project',function ($query){
                $query->where('status','open');
            })->latest()->paginate(25);
        }elseif($request->status == 'rejected'){
            $offers = user()->offers()->whereHas('project',function ($query){
                $query->where('freelancer_id','!=',user()->id);
            })->latest()->paginate(25);
        }
        return view('User.Freelancer.index',compact('offers','request'));
    }

    public function judge()
    {
        return view('User.Freelancer.judge');
    }
}
