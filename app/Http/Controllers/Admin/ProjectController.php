<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use App\Offer;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(100);
        $title = 'آخرین پروژه ها';
        return view('Admin.Projects.index',compact('projects','title'));
    }

    public function pending()
    {
        $projects = Project::latest()->where('publish_status','pending')->paginate(100);
        $title = 'پروژه های در انتظار تایید';
        return view('Admin.Projects.index',compact('projects','title'));
    }

    public function canceled()
    {
        $projects = Project::latest()->where('publish_status','canceled')->paginate(100);
        $title = 'پروژه های لغو شده';
        return view('Admin.Projects.index',compact('projects','title'));
    }

    public function closed()
    {
        $projects = Project::latest()->where('publish_status','closed')->paginate(100);
        $title = 'پروژه های پایان یافته';
        return view('Admin.Projects.index',compact('projects','title'));
    }

    public function search()
    {
        return view('Admin.Projects.search');
    }

    public function searchPost(Request $request)
    {
        $projects = Project::latest();
        $empty = true;
        $features = [];
        if($request->id){
            $projects = $projects->whereId($request->id);
            $empty = false;
        }
        if($request->title){
            $projects = $projects->whereIsLike('title',$request->title);
            $empty = false;
        }
        if($request->price_range){
            $projects = $projects->where('price_range',$request->price_range);
            $empty = false;
        }
        if($request->publish_status){
            $projects = $projects->where('publish_status',$request->publish_status);
            $empty = false;
        }
        if($request->status){
            $projects = $projects->where('status',$request->status);
            $empty = false;
        }
        if($request->features){
            $features = array_flip($request->features);
            if(isset($features['hidden'])){
                $projects = $projects->where('hidden',1);
            }
            if(isset($features['hire'])){
                $projects = $projects->where('hire',1);
            }
            if(isset($features['urgent'])){
                $projects = $projects->where('urgent',1);
            }
            if(isset($features['sticky'])){
                $projects = $projects->where('sticky',1);
            }
            if(isset($features['private'])){
                $projects = $projects->where('private',1);
            }
            if(isset($features['special'])){
                $projects = $projects->where('special',1);
            }
            $empty = false;
        }
        if($empty){
            alert()->error('عملیات نا موفق','حداقل یک فیلد را باید پر کنید !');
            return redirect()->back();
        }
        $projects = $projects->get();
        $page = 'search';
        $title = 'جستجوی پروژه';
        return view('Admin.Projects.index',compact('projects','page','request','features','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('projects.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('Admin.Projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = [
            'title' => $request->title,
            'price_range' => $request->price_range,
            'deadline' => $request->deadline,
            'min_guarantee' => $request->min_guarantee ?? 0,
            'expires_at' => Carbon::createFromTimestamp(intval(substr($request->expires_at, 0, -3)),'Asia/Tehran')->toDateTimeString(),
            'content' => $request->input('content'),
        ];
        if($request->has('status')){
            $data['status'] = $request->status;
        }
        if($request->has('publish_status')){
            $data['publish_status'] = $request->publish_status;
        }
        if($request->has('features')){
            $features = array_flip($request->features);
            if(isset($features['hidden'])){
                $data['hidden'] = 1;
            }
            if(isset($features['special'])){
                $data['special'] = 1;
            }
            if(isset($features['hire'])){
                $data['hire'] = 1;
            }
            if(isset($features['urgent'])){
                $data['urgent'] = 1;
            }
            if(isset($features['private'])){
                $data['private'] = 1;
            }
            if(isset($features['sticky'])){
                $data['sticky'] = 1;
            }
        }
        $project->update($data);
        alert()->success('عملیات موفق ','اطلاعات پروژه بروزرسانی شد !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->removeThis();
        alert()->warning('تبریک!','با موفقیت حذف شد');
        return redirect(route('projects.index'));
    }

    public function confirm(Project $project)
    {
        $project->update([
            'is_paid' => true,
            'confirmed_at' => now(),
            'expires_at' => now()->addMonth(),
            'publish_status' => 'open'
        ]);
        alert()->success('تبریک!','با موفقیت در وبسایت انتشار یافت !');
        return redirect(route('projects.index'));
    }

    public function deactivate(Project $project)
    {
        $project->update([
            'confirmed_at' => null,
            'publish_status' => 'pending'
        ]);
        alert()->warning('تبریک!','پروژه در وبسایت معلق شد و در لیست پروژه ها نمایش داده نخواهد شد !');
        return redirect(route('projects.index'));
    }

    public function deleteOffer(Offer $offer)
    {
        $isDefault = $offer->project()->finalOffer()->id == $offer->id;
        if($isDefault){
            alert()->error('خطا !','امکان حذف این پیشنهاد نیست , این پیشنهاد توسط کارفرما پذیرفته شده !');
            return redirect()->back();
        }
        $offer->delete();
        alert()->success('عملیات موفق !','پیشنهاد با موفقیت حذف شد !');
        return redirect()->back();
    }

    public function assign(Offer $offer)
    {
        $isDefault = $offer->project()->status != 'open';
        if($isDefault){
            alert()->error('خطا !','برای پذیرش پیشنهاد باید وضعیت پروژه باز باشد !');
            return redirect()->back();
        }
        $offer->project()->update(['offer_id'=>$offer->id,'freelancer_id'=>$offer->user->id]);
        // Notification
        Notification::create([
            'text' => sprintf('پیشنهاد شما در پروژه %s پذیرفته شد !',limit($offer->project()->title,30,'')),
            'user_id' => $offer->user->id,
            'url' => $offer->project()->conversationLink(),
            'type' => 'success'
        ]);
        // Employer Should Pay The Trust If There is Prepayment Trust Or Price Is Less than 1,000,000
        if(intval($offer->project()->finalOffer()->prepayment) > 0 || intval($offer->project()->finalOffer()->price) < 1000000){
            $offer->project()->update(['status'=>'emp_trust']);
            // Notification
            Notification::create([
                'text' => sprintf('شما باید در پروژه %s گروگزاری کنید',limit($offer->project()->title,30,'')),
                'user_id' => $offer->project()->user->id,
                'url' => $offer->project()->conversationLink(\user()),
                'type' => 'warning'
            ]);
        }elseif (intval($offer->project()->finalOffer()->warranty) > 0){
            $offer->project()->update(['status'=>'flc_trust','starts_at'=>now()]);
            // Notification
            Notification::create([
                'text' => sprintf('شما باید در پروژه %s گروگزاری کنید',limit($offer->project()->title,30,'')),
                'user_id' => $offer->user->id,
                'url' => $offer->project()->conversationLink(),
                'type' => 'warning'
            ]);
        }else {
            $offer->project()->update(['status'=>'trust_done','starts_at'=>now()]);
        }
        alert()->success('عملیات موفق !','پیشنهاد با موفقیت تایید شد !');
        return redirect()->back();
    }
}
