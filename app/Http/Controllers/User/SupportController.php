<?php

namespace App\Http\Controllers\User;

use App\Notification;
use App\Project;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = user()->supports()->paginate(20);
        return view('User.Support.index',compact('tickets'));
    }

    public function create()
    {
        $projects = user()->projects()->select(['id','title'])->latest()->get();
        $jobs = user()->jobs()->select(['id','title'])->latest()->get();
        $projects = $projects->merge($jobs);
        return view('User.Support.create',compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:5',
            'type' => 'required',
            'content' => 'required|min:15'
        ]);
        if($request->project){
            $project_id = $request->project;
        }elseif($request->project_id) {
            $project_id = $request->project_id;
        }
        $ticket = user()->supports()->create([
            'title' => $request->title,
            'type' => $request->type,
            'content' => justBr(nl2br($request->get('content'))),
            'project_id' => isset($project_id) ? intval($project_id) : null
        ]);
        if($request->page == 'judgment'){
            if($request->has('private') && !boolval($request->private)){
                $project = Project::whereId($project_id)->first();
                $target_id = $project->isFreelancer() ? $project->user_id : $project->freelancer_id;
                $ticket->update([
                    'target_id' => $target_id
                ]);
                Notification::create([
                    'text' => sprintf('یک درخواست داوری برای پروژه %s ایجاد شده !',limit($project->title,30,'')),
                    'user_id' => $target_id,
                    'url' => $ticket->link(),
                    'type' => 'danger'
                ]);
            }
            alert()->success('عملیات موفق !','درخواست داوری شما با موفقیت ثبت شد , در اسرع وقت توسط تیم داوری بررسی خواهد شد');
        }else {
            alert()->success('عملیات موفق !','تیکت پشتیبانی شما با موفقیت ایجاد شد و در اسرع وقت توسط تیم پشتیبانی بررسی خواهد شد');
        }
        return redirect()->route('support');
    }
    public function contact()
    {
        return view('User.Support.contact');
    }

    public function judge(Project $project)
    {
        return view('User.Support.judge',compact('project'));
    }

    public function view(Ticket $ticket)
    {
        if(!$ticket->authorize()){
            return redirect()->route('support');
        }
        return view('User.Support.view',compact('ticket'));
    }

    public function action(Ticket $ticket,$action=null)
    {
        if(user()->admin){
            if($action == 'invite'){
                if($ticket->target){
                    alert()->warning('خطا!','کاربر مورد نظر قبلا به تیکت دعوت شده است !');
                    return redirect()->back();
                }
                $target = $ticket->project->isFreelancer($ticket->user) ? $ticket->project->user_id : $ticket->project->freelancer_id;
                $ticket->update([
                    'target_id' => intval($target)
                ]);
                Notification::create([
                    'text' => sprintf('یک درخواست داوری برای پروژه %s ایجاد شده !',limit($ticket->project->title,30,'')),
                    'user_id' => intval($target),
                    'url' => $ticket->link(),
                    'type' => 'danger'
                ]);
                alert()->success('عملیات موفق','طرف دعوی با موفقیت به تیکت دعوت شد !');
                return redirect()->back();
            }elseif($action == 'close'){
                if($ticket->status == 'closed'){
                    alert()->warning('خطا!','تیکت مورد نظر قبلا بسته شده است !');
                    return redirect()->back();
                }
                $ticket->update([
                    'status' => 'closed'
                ]);
                alert()->success('عملیات موفق','تیکت مورد نظر با موفقیت بسته شد!');
                return redirect()->back();
            }else {
                alert()->warning('خطا !','عملیات ناشناخته !');
                return redirect()->back();
            }
        }else {
            return redirect()->back();
        }
    }
}
