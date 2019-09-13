<?php

namespace App\Http\Controllers\User;

use App\Account;
use App\Notification;
use App\Payment;
use App\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Invoice;

class FinancialController extends Controller
{
    public function index()
    {
        return view('User.Financial.index');
    }

    public function increase()
    {
        return view('User.Financial.increase');
    }

    public function edit()
    {
        return view('User.Financial.edit');
    }

    public function withdraw()
    {
        return view('User.Financial.withdraw');
    }

    public function pay($amount=null)
    {
        return view('User.Financial.pay',compact('amount'));
    }

    public function payIt(Request $request)
    {
        $amount = intval($request->amount) ?? 0;
        $min = option('min_payment') ?? 5000;
        if($amount >= intval($min)){
            $payment = Payment::create([
                'price' => $amount,
                'user_id' => auth()->id(),
                'status' => false,
                'message' => 'افزایش اعتبار',
                'method' => 'online'
            ]);
            $invoice = new Invoice();
            $invoice->amount($amount);
            $invoice->uuid($payment->id);
            $invoice->detail(['detailName' => 'افزایش اعتبار کاربر #' . user()->id]);
            return \Shetabit\Payment\Facade\Payment::purchase($invoice, function($driver, $transactionId) use ($payment) {
                $payment->update([
                    'refId' => $transactionId
                ]);
            })->pay();
        }else {
            alert()->error('خطا !',sprintf('مبلغ پرداختی شما باید حداقل %s باشد !',money(intval($min))));
            return redirect()->back();
        }
    }

    public function verifyPayment(Request $request)
    {
        $payment = user()->payments()->latest()->first();
        if($payment->refId != $request->Authority){
            alert()->error('خطا !','اطلاعات پرداخت شما نامعتبر است , لطفا با پشتیبانی تماس بگیرید !');
            return redirect()->route('money.index');
        }
        try {
            \Shetabit\Payment\Facade\Payment::amount(intval($payment->price))->transactionId($payment->refId)->verify();
            user()->balance($payment->price,'+');
            $payment->update([
                'status' => true
            ]);
            alert()->success('تبریک !','پرداخت شما با موفقیت انجام شد !');
            return redirect()->route('money.index');
        } catch (InvalidPaymentException $exception) {
            alert()->error('خطا !',$exception->getMessage());
            return redirect()->route('money.index');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|max:30|string',
            'last_name' => 'required|max:30|string',
            'sheba' => 'required|min:26|max:26|starts_with:IR',
            'cart_number' => 'required|min:16|max:16',
            'number' => 'required|max:16',
            'bank' => 'required'
        ]);
        Account::create([
            'user_id' => auth()->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'sheba' => $request->sheba,
            'cart_number' => $request->cart_number,
            'number' => $request->number,
            'bank' => $request->bank,
        ]);
        alert()->success('عملیات موفق !','اطلاعات حساب اضافه شد !');
        return redirect()->route('money.edit');
    }

    public function withdrawStore(Request $request)
    {
        $this->validate($request,[
            'price' => 'required|gte:5000|lte:' .user()->balance,
            'account_id' => 'required'
        ]);
        $acc = Account::find(intval($request->account_id))->first();
        $price = intval($request->price);
        user()->balance($price,'-');
        if($acc){
            Withdraw::create([
                'price' => $price,
                'account_id' => $acc->id,
                'user_id' => auth()->id(),
                'bank' => $acc->bank,
            ]);
            Notification::create([
                'text' => sprintf('درخواست واریز شما به مبلغ %s ثبت گردید !',money($price)),
                'user_id' => auth()->id(),
                'url' => route('money.index'),
                'type' => 'success'
            ]);
            alert()->success('عملیات موفق !','درخواست واریز ثبت شد , با توجه به انجام واریز ها با حواله پایا، وجه چند ساعت بعد از واریز به حساب شما منتقل می گردد.');
            return redirect()->route('money.index');
        }else {
            alert()->error('عملیات نا موفق !','حساب مورد نظر موجود نیست !');
            return redirect()->route('money.withdraw');
        }
    }
}
