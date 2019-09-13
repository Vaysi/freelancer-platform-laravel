<?php

namespace App\Http\Middleware;

use Closure;

class lastLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()){
            if(user()->banned){
                auth()->logout();
                alert()->error('خطا در ورود !','حساب کاربری شما مسدود شده و امکان ورود به پنل کاربری نیست , با پشتیبانی سایت تماس بگیرید !')->persistent();
                return redirect()->route('login');
            }
            if(!$request->cookie('last_login')){
                auth()->user()->update([
                    'last_login' => now()
                ]);
                return $next($request)->cookie(
                    'last_login', encrypt(now()), 60
                );
            }else {
                return $next($request);
            }
        }else {
            return $next($request);
        }

    }
}
