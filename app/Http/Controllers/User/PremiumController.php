<?php

namespace App\Http\Controllers\User;

use App\Package;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PremiumController extends Controller
{
    public function index()
    {
        return view('User.Premium.index');
    }

    public function update(Package $package)
    {
        if($package->is_default){
            alert()->warning('خطا در انجام عملیات !','این پلن رایگان است و امکان ارتقا حساب به این پلن نیست !');
            return redirect()->route('premium');
        }
        if(intval($package->min) > user()->doneJobs()){
            alert()->warning('خطا در انجام عملیات !',sprintf('برای ارتقا به این پنل باید حداقل %s پروژه موفق داشته باشید',$package->min));
            return redirect()->route('premium');
        }
        $p = optional(user()->package());
        if(boolval($p->id) && $p->id == $package->id){
            $diff = Carbon::now()->diffInDays(user()->expires_at);
            if($diff >= 6){
                alert()->warning('خطا در انجام عملیات !','برای تمدید پلن حداقل باید کمتر از 7 روز به انقضای پلن خود داشته باشید');
                return redirect()->route('premium');
            }
        }
        if(user()->balance(intval($package->price))){
            user()->update([
                'package_id' => $package->id,
                'starts_at' => now(),
                'expires_at' => now()->addDays(intval($package->length))
            ]);
            user()->balance(intval($package->price),'-');
            option('earning',intval(option('earning')) + $package->price);
            option('premium',intval(option('premium')) + $package->price);
            Payment::create([
                'price' => $package->price,
                'user_id' => \user()->id,
                'status' => true,
                'message' => sprintf('ارتقای حساب به %s',$package->name),
                'model' => 'Package',
                'model_id' => $package->id
            ]);
            // Calculate Fee
            $fee = intval(option('upgrade_fee'));
            if(\user()->inviter()->count()){
                $isMorethan1Year = jdate(\user()->created_at)->addDays(365)->getTimestamp() >= now()->timestamp;
                if(\user()->fee_times <= intval(option('fee_times')) && $isMorethan1Year){
                    $parentPaid = getPercent($package->price,$fee,true);
                    \user()->inviter()->balance($parentPaid,'+');
                    Notification::create([
                        'text' => sprintf('شما مبلغ %s از ارتقا حساب کاربر %s سود معرف دریافت کردید !',money($parentPaid),\user()->nicky),
                        'user_id' => \user()->inviter->id,
                        'url' => route('money.index'),
                        'type' => 'success'
                    ]);
                }
            }
            // Calculate Fee
            alert()->warning('عملیات موفق !',sprintf('پکیج «%s» با موفقیت فعال شد !',$package->name));
            return redirect()->route('premium');
        }else {
            $shouldPay = intval($package->price) - user()->balance;
            return redirect(route('money.pay',['amount'=>$shouldPay]));
        }
    }
}
