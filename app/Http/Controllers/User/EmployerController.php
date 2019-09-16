<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployerController extends Controller
{
    public function index()
    {
        $projects = user()->projects()->latest()->paginate(20);
        return view('User.Employer.index',compact('projects'));
    }

    public function filter(Request $request)
    {
        $projects = user()->projects();
        if($request->title){
            $projects = $projects->where('title','sounds like',strip_tags($request->title));
        }
        if($request->status && !empty($request->status)){
            $status = '';
            if($request->status == 'open'){
                $status = 'open';
            }elseif($request->status == 'closed'){
                $status = ['closed','ended'];
            }elseif($request->status == 'working'){
                $status = ['flc_done','trust_done','flc_trust','emp_trust'];
            }
            if($status == ''){
                if($request->status == 'draft'){
                    $projects = $projects->where('publish_stauts','draft');
                }elseif($request->status == 'pending'){
                    $projects = $projects->where('confirmed_at',null);
                }
            }else {
                $projects = $projects->where('status',$status);
                if($status == 'open'){
                    $projects = $projects->whereDate('expires_at','>',now());
                }
            }
        }
        $projects = $projects->latest()->paginate(20);
        return view('User.Employer.index',compact('projects','request'));
    }

    public function findFilter(Request $request)
    {
        if($request->name || $request->skills[0]){
            if($request->name){
                $users = User::whereLike('nickname',$request->name)->whereLike('name',$request->name);
            }
            $skills = $request->skills;
            if($request->skills[0] && is_null($request->name)){
                $users = User::whereHas('skills', function (Builder $query) use ($skills) {
                    $query->whereIn('skill_id',array_values($skills));
                });
            }elseif($request->skills[0] && !is_null($request->name)) {
                $users = $users->whereHas('skills', function (Builder $query) use ($skills) {
                    $query->whereIn('skill_id',array_values($skills));
                });
            }
            $users = $users->orderBy('score')->orderBy('updated_at')->paginate(25);
            $render = $users->render();
            $users = $users->sortByDesc(function ($product){
                return $product->allJobs();
            });
            return view('User.Employer.find',compact('users','render'));
        }else {
            alert()->error('خطا!','حداقل فیلد نام یا مهارت را وارد کنید !');
            return redirect()->route('employer.find');
        }
    }

    public function find()
    {
        $users = User::orderBy('score')->orderBy('updated_at')->paginate(25);
        $render = $users->render();
        $users = $users->sortByDesc(function ($product){
            return $product->allJobs();
        });
        return view('User.Employer.find',compact('users','render'));
    }

    public function judge()
    {
        return view('User.Employer.judge');
    }
}
