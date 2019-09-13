<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helps = Question::whereType('help')->latest()->paginate(100);
        return view('Admin.Helps.index',compact('helps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Helps.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Question::create(array_merge($request->only(['title','content','location']),['type'=>'help']));
        alert()->success('تبریک!','راهنمای مورد نظر با موفقیت ایجاد شد !');
        return redirect(route('helps.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return redirect(route('helps.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $help = $question;
        return view('Admin.Helps.edit',compact('help'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update(array_merge($request->only(['title','content','location']),['type'=>'help']));
        alert()->success('تبریک!','راهنمای مورد نظر با موفقیت بروزرسانی شد !');
        return redirect(route('helps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $question->delete();
        alert()->warning('تبریک!','راهنمای مورد نظر با موفقیت حذف شد!');
        return redirect(route('helps.index'));
    }
}
