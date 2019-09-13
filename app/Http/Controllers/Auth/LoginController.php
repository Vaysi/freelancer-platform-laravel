<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Login;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        // Save Failed Login Attemp
        if($user = User::whereEmail($request->email)->first()){
            $user->loginHistory()->create([
                'status' => false,
                'ip' => $request->ip(),
                'ua' => $request->userAgent()
            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user){
        $user->loginHistory()->create([
            'status' => true,
            'ip' => $request->ip(),
            'ua' => $request->userAgent()
        ]);
    }

    public function redirectToProvider($driver = 'google'){
        $services = config('services.autoLogin');
        $driver = in_array($driver,$services) ? $driver : 'google';
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver = 'google')
    {
        $user = Socialite::driver($driver)->user();
        if($user){
            $myuser = User::whereEmail($user->email)->first();
            if(!boolval(optional($myuser)->id)){
                $myuser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt($user->id),
                    'email_verified_at' => now()
                ]);
                alert()->success('تبریک !',"شما با موفقیت در پروژستان عضو شدید \n برای استفاده بهینه از سایت بهتر است پروفایل خود را تکمیل کنید !");
            }

            if(!boolval($myuser->email_verified_at)){
                $myuser->update([
                    'email_verified_at' => now()
                ]);
            }

            auth()->loginUsingId($myuser->id);

            if($myuser->admin){
                return redirect()->route('adminDashboard');
            }else {
                return redirect()->route('userDashboard');
            }
        }else {
            abort(403);
        }
    }
}
