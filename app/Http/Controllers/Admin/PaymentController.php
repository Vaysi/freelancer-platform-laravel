<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use App\Payment;
use App\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $earning = option('earning') ?? option('earning',0);
        $site = option('site') ?? option('site',0);
        $projectsFee = option('projectsFee') ?? option('projectsFee',0);
        $premium = option('premium') ?? option('premium',0);
        $payments = Payment::where('type','!=','release')->latest()->paginate(100);
        return view('Admin.Payments.index',compact('earning','site','projectsFee','premium','payments'));
    }

    public function suc()
    {
        $payments = Payment::where('type','!=','release')->where('status',1)->latest()->paginate(100);
        return view('Admin.Payments.successful',compact('payments'));
    }

    public function unsuc()
    {
        $payments = Payment::where('type','!=','release')->where('status',0)->latest()->paginate(100);
        return view('Admin.Payments.unsuccessful',compact('payments'));
    }

    public function deposits()
    {
        $payments = Payment::where('type','deposit')->latest()->paginate(100);
        return view('Admin.Payments.deposits',compact('payments'));
    }

    public function release()
    {
        $payments = Payment::where('type','release')->latest()->paginate(100);
        return view('Admin.Payments.release',compact('payments'));
    }

    public function withdraws()
    {
        $withdraws = Withdraw::latest()->paginate(100);
        $title = 'آخرین درخواست های واریز';
        return view('Admin.Payments.withdraws',compact('withdraws','title'));
    }

    public function successful()
    {
        $withdraws = Withdraw::where('status','deposited')->latest()->paginate(100);
        $title = 'آخرین درخواست های واریز انجام شده';
        return view('Admin.Payments.withdraws',compact('withdraws','title'));
    }

    public function canceled()
    {
        $withdraws = Withdraw::where('status','canceled')->latest()->paginate(100);
        $title = 'آخرین درخواست های لغو شده';
        return view('Admin.Payments.withdraws',compact('withdraws','title'));
    }

    public function pending()
    {
        $withdraws = Withdraw::where('status','pending')->latest()->paginate(100);
        $title = 'آخرین درخواست های در انتظار واریز';
        return view('Admin.Payments.withdraws',compact('withdraws','title'));
    }

    public function view(Withdraw $withdraw)
    {
        return view('Admin.Payments.view',compact('withdraw'));
    }

    public function pay(Withdraw $withdraw,Request $request)
    {
        if($request->has('pay')){
            $withdraw->update([
                'refId' => $request->refId,
                'status' => 'deposited'
            ]);
            // Notification
            Notification::create([
                'text' => sprintf('درخواست واریز شما به مبلغ %s تایید و واریز شد !',money($withdraw->price)),
                'user_id' => $withdraw->user->id,
                'url' => route('money.index'),
                'type' => 'success'
            ]);
        }elseif($request->has('cancel')){
            $withdraw->user->balance($withdraw->price,'+');
            $withdraw->update([
                'status' => 'canceled',
                'rejection_cause' => $request->rejection_cause
            ]);
            // Notification
            Notification::create([
                'text' => sprintf('درخواست واریز شما به مبلغ %s لغو شد !',money($withdraw->price)),
                'user_id' => $withdraw->user->id,
                'url' => route('money.index'),
                'type' => 'danger'
            ]);
        }
        alert()->success('عملیات موفق !','تصمیم شما به کاربر اعلان شد !');
        return redirect()->route('withdraws.view',['withdraw'=>$withdraw->id]);
    }
}
