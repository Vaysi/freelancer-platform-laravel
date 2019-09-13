<?php

namespace App\Http\Controllers\Auth;

use App\Notification;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dd = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];
        if(request()->cookie('ref')){
            $dd['parent_id'] = intval(request()->cookie('ref'));
            Notification::create([
                'text' => sprintf('یک کاربر جدید به لیست کاربران معرفی شده شما اضافه شد و از این پس شما از روی تراکنش های ایشان درآمد کسب خواهید کرد'),
                'user_id' => intval(request()->cookie('ref')),
                'url' => route('affiliate.report'),
                'type' => 'success'
            ]);
        }
        return User::create($dd);
    }

    protected function registered(Request $request, $user)
    {
        alert()->success('تبریک میگیم !','شما با موفقیت عضوی از پروژستان شدید !');
    }
}
