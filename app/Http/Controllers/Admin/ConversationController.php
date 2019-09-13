<?php

namespace App\Http\Controllers\Admin;

use App\Conversation;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('project_id','!=',null)->latest()->paginate(150);
        $title = 'آخرین گفتگو ها';
        return view('Admin.Conversations.index',compact('conversations','title'));
    }

    public function pending()
    {
        $conversations = Conversation::where('project_id','!=',null)->where('status','pending')->latest()->paginate(150);
        $title = 'گفتگو های در انتظار تایید';
        return view('Admin.Conversations.index',compact('conversations','title'));
    }

    public function rejected()
    {
        $conversations = Conversation::where('project_id','!=',null)->where('status','rejected')->latest()->paginate(150);
        $title = 'گفتگو های رد شده';
        return view('Admin.Conversations.index',compact('conversations','title'));
    }

    public function active(Conversation $conversation)
    {
        if($conversation->status != 'confirmed'){
            $conversation->update([
                'status' => 'confirmed'
            ]);
            $user = $conversation->to->id == $conversation->project->user_id ? $conversation->user : null;
            Notification::create([
                'text' => sprintf('پیام جدیدی برای پروژه %s از طرف کاربر %s ارسال شده',limit($conversation->project->title,30,''),$conversation->user->nicky),
                'user_id' => $conversation->to->id,
                'url' => $conversation->project()->conversationLink($user) . '#msg' . $conversation->id
            ]);
            alert()->success('تبریک !','پیام با موفقیت تایید شد !');
        }else {
            alert()->warning('خطا !','این پیام در حال حاضر تایید شده است !');
        }
        return redirect()->back();
    }

    public function reject(Conversation $conversation)
    {
        if($conversation->status != 'rejected'){
            $conversation->update([
                'status' => 'rejected'
            ]);
            alert()->info('تبریک !','پیام با موفقیت رد شد !');
        }else {
            alert()->warning('خطا !','این پیام در حال حاضر تایید شده است !');
        }
        return redirect()->back();
    }
}
