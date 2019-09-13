<?php

namespace App\Http\Controllers\Admin;

use App\link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::latest()->paginate(100);
        return view('Admin.Links.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Links.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Link::create($request->only(['title','link','type']));
        alert()->success('تبریک!','لینک مورد نظر با موفقیت ایجاد شد !');
        return redirect(route('links.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(link $link)
    {
        return redirect(route('links.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(link $link)
    {
        return view('Admin.Links.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, link $link)
    {
        $link->update($request->only(['title','link','type']));
        alert()->success('تبریک!','لینک مورد نظر با موفقیت بروزرسانی شد !');
        return redirect(route('links.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\link $link
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(link $link)
    {
        $link->delete();
        alert()->warning('تبریک!','لینک مورد نظر با موفقیت حذف شد!');
        return redirect(route('links.index'));
    }
}
