<?php

namespace App\Http\Controllers\Admin;

use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::orderBy('id')->paginate(100);
        return view('Admin.Skills.index',compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Skills.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Skill::create($request->except(['_token']));
        alert()->success('تبریک!','مهارت مورد نظر با موفقیت ایجاد شد !');
        return redirect(route('skills.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return redirect(route('skills.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view('Admin.Skills.edit',compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $skill->update($request->except(['_token']));
        alert()->success('تبریک!','مهارت مورد نظر با موفقیت بروزرسانی شد !');
        return redirect(route('skills.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill $skill
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        alert()->warning('تبریک!','مهارت مورد نظر با موفقیت حذف شد!');
        return redirect(route('skills.index'));
    }
}
