<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(100);
        return view('Admin.Users.index',compact('users'));
    }

    public function ban(User $user)
    {
        if($user->banned){
            $user->update([
                'banned' => 0
            ]);
        }else {
            if(!$user->admin){
                $user->update([
                    'banned' => 1
                ]);
            }else {
                alert()->error('عملیات نا موفق','امکان بن کردن حساب ادمین ها وجود ندارد ( برای مسدود سازی حساب با پشتیبانی تماس بگیرید )');
                return redirect()->back();
            }
        }
        alert()->info('عملیات موفق','عملیات با موفقیت انجام شد !');
        return redirect()->back();
    }

    public function search()
    {
        return view('Admin.Users.search');
    }

    public function searchPost(Request $request)
    {
        $users = User::where('banned',boolval($request->banned));
        $empty = true;
        if($request->name){
            $users = $users->whereIsLike('nickname',$request->name)->whereLike('name',$request->name);
            $empty = false;
        }
        if($request->phone){
            $users = $users->whereIsLike('phone',$request->phone);
            $empty = false;
        }
        if($request->email){
            $users = $users->whereIsLike('email',$request->email);
            $empty = false;
        }
        if($empty){
            alert()->error('عملیات نا موفق','حداقل یک فیلد را باید پر کنید !');
            return redirect()->back();
        }
        $users = $users->get();
        $page = 'search';
        return view('Admin.Users.index',compact('users','page','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('Admin.Users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = [
          'name' => $request->name,
          'nickname' => $request->nickname,
          'email' => $request->email,
            'phone' => $request->phone ?? null ,
            'balance' => $request->balance ?? 0 ,
            'expires_at' => Carbon::createFromTimestamp(intval(substr($request->expires_at, 0, -3)),'Asia/Tehran')->toDateTimeString(),
            'package_id' => $request->package_id,
            'admin' => boolval($request->admin),
        ];
        if($request->has('avatar')){
            $data['avatar'] = $request->avatar;
        }
        $user->update($data);
        alert()->success('عملیات موفق ','عملیات کاربر بروزرسانی شد !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return redirect()->route('users.index');
    }
}
