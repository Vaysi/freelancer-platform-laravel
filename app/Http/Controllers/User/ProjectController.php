<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\File;
use App\Notification;
use App\Offer;
use App\Payment;
use App\Project;
use App\Skill;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Itsdp\FilepondServer\Filepond;
use Shetabit\Payment\Invoice;

class ProjectController extends Controller
{
    public function index()
    {
        return view('User.Project.new');
    }

    public function store(Request $request)
    {
        // Forget This Items From Request
        $forget = ['subcategory','_token','skills','file','draft'];
        // If Subcategory Exits Replace Category_id
        if($request->subcategory){
            $request = $request->merge([
                'category_id' => $request->subcategory
            ]);
        }
        // Validate Before Create
        $this->validate($request,[
            'title' => 'required|min:10|max:290',
            'category_id' => 'required',
            'skills' => 'required',
            'content' => 'required|min:20|max:4000',
            'price_range' => 'required|lt:7|gte:0',
            'min_guarantee' => 'required|lt:26|gte:0',
            'deadline' => 'required',
        ]);
        // Initialize Project Data
        $data = $request->except($forget);
        $data['expires_at'] = now()->addMonth();
        $data['user_id'] = user()->id;
        // if is Draft
        if($request->has('draft')){
            $data['publish_status'] = 'draft';
        }
        // Create Project
        $project = Project::create($data);
        // Create Skills
        $items = array_slice(array_unique($request->skills), 0, 8);
        foreach ($items as $skill){
            $ski = Skill::find($skill);
            $project->skills()->save($ski);
        }
        // Upload Files
        if($request->file){
            $this->uploadFiles($request->file,$project,'project_id');
        }
        // Calculate The Price
        $price = option('normal') ?? 5000;
        $private = option('private') ?? 5000;
        $hidden = option('hidden') ?? 6500;
        $special = option('special') ?? 22000;
        $urgent = option('urgent') ?? 6500;
        $hire = option('hire') ?? 50000;
        $sticky = option('sticky') ?? 65000;
        if($project->private){
            $price += $private;
        }
        if($project->hidden){
            $price += $hidden;
        }
        if($project->special){
            $price += $special;
        }
        if($project->urgent){
            $price += $urgent;
        }
        if($project->hire){
            $price += $hire;
        }
        if($project->sticky){
            $price += $sticky;
        }
        if(!$project->is_paid && $project->publish_status != 'draft'){
            if($price > user()->balance){
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }else {
                \user()->balance($price,'-');
                option('site',intval(option('site')) + $price);
                option('earning',intval(option('earning')) + $price);
                $project->update([
                    'is_paid' => true
                ]);
                Payment::create([
                    'price' => $price,
                    'user_id' => auth()->id(),
                    'status' => true,
                    'message' => 'ثبت پروژه '.$project->title,
                    'model' => 'Project',
                    'model_id' => $project->id,
                ]);
                alert()->success('عملیات موفق !','پروژه شما با موفقیت ثبت شد و دقایقی بعد (پس از تایید پروژه توسط مدیریت) در فهرست پروژه ها قرار خواهد گرفت ');
                return redirect()->back();
            }
        }else {
            alert()->success('عملیات موفق !','تغیرات با موفقیت ذخیره شد !');
            return redirect()->back();
        }
    }

    public function edit(Project $project)
    {
        if(!in_array($project->publish_status,['pending','open'])){
            return redirect()->route('userDashboard');
        }
        return view('User.Project.edit',compact('project'));
    }

    public function update(Project $project,Request $request)
    {
        if(!in_array($project->publish_status,['pending','open'])){
            return redirect()->route('userDashboard');
        }
        // Forget This Items From Request
        $forget = ['subcategory','_token','skills','file','draft','_method','hidden','private','special','hire','sticky','special'];
        // If Subcategory Exits Replace Category_id
        if($request->subcategory){
            $request = $request->merge([
                'category_id' => $request->subcategory
            ]);
        }
        // Validate Before Create
        $this->validate($request,[
            'title' => 'required|min:10|max:290',
            'category_id' => 'required',
            'skills' => 'required',
            'content' => 'required|min:20|max:4000',
            'price_range' => 'required|lt:7|gte:0',
            'min_guarantee' => 'required|lt:26|gte:0',
            'deadline' => 'required',
        ]);
        // Calculate The Price
        $price = option('normal') ?? 5000;
        $private = option('private') ?? 5000;
        $hidden = option('hidden') ?? 6500;
        $special = option('special') ?? 22000;
        $urgent = option('urgent') ?? 6500;
        $hire = option('hire') ?? 50000;
        $sticky = option('sticky') ?? 65000;
        // Price For Update
        $uprice = 0;
        if(!$project->private && $request->has('private')){
            $uprice += $private;
        }
        if(!$project->hidden && $request->has('hidden')){
            $uprice += $hidden;
        }
        if(!$project->special && $request->has('special')){
            $uprice += $special;
        }
        if(!$project->urgent && $request->has('urgent')){
            $uprice += $urgent;
        }
        if(!$project->hire && $request->has('hire')){
            $uprice += $hire;
        }
        if(!$project->sticky && $request->has('sticky')){
            $uprice += $sticky;
        }
        // Initialize Project Data
        $data = $request->except($forget);
        $data['expires_at'] = now()->addMonth();
        $data['user_id'] = user()->id;
        if($project->publish_status == 'pending' && $request->has('draft')){
            $data['publish_status'] = 'draft';
        }
        // Create Project
        $project->update($data);
        // Create Skills
        $items = array_slice(array_unique($request->skills), 0, 8);
        $project->skills()->detach();
        foreach ($items as $skill){
            $ski = Skill::find($skill);
            $project->skills()->save($ski);
        }
        // Upload Files
        if($request->file){
            $this->uploadFiles($request->file,$project,'project_id');
        }
        if($project->private){
            $price += $private;
        }
        if($project->hidden){
            $price += $hidden;
        }
        if($project->special){
            $price += $special;
        }
        if($project->urgent){
            $price += $urgent;
        }
        if($project->hire){
            $price += $hire;
        }
        if($project->sticky){
            $price += $sticky;
        }
        if(!$project->is_paid && $project->publish_status != 'draft'){
            if($price > user()->balance){
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }else {
                \user()->balance($price,'-');
                option('site',intval(option('site')) + $price);
                option('earning',intval(option('earning')) + $price);
                $project->update([
                    'is_paid' => true,
                    'confirmed_at' => null
                ]);
                Payment::create([
                    'price' => $price,
                    'user_id' => auth()->id(),
                    'status' => true,
                    'message' => 'ثبت پروژه '.$project->title,
                    'model' => 'Project',
                    'model_id' => $project->id,
                ]);
                alert()->success('عملیات موفق !','پروژه شما با موفقیت ویرایش شد و در انتظار تایید مدیریت میباشد !');
                return redirect()->back();
            }
        }else {
            if($uprice > 0){
                if($uprice > user()->balance){
                    $shouldPay = $uprice - user()->balance;
                    return redirect(route('money.pay',['amount'=>$shouldPay]));
                }else {
                    \user()->balance($uprice,'-');
                    option('site',intval(option('site')) + $uprice);
                    option('earning',intval(option('earning')) + $uprice);
                    $data = [];
                    if(!$project->private && $request->has('private')){
                        $data['private'] = 1;
                    }
                    if(!$project->hidden && $request->has('hidden')){
                        $data['hidden'] = 1;
                    }
                    if(!$project->special && $request->has('special')){
                        $data['special'] = 1;
                    }
                    if(!$project->urgent && $request->has('urgent')){
                        $data['urgent'] = 1;
                    }
                    if(!$project->hire && $request->has('hire')){
                        $data['hire'] = 1;
                    }
                    if(!$project->sticky && $request->has('sticky')){
                        $data['sticky'] = 1;
                    }
                    $data['confirmed_at'] = null;
                    $project->update($data);
                    Payment::create([
                        'price' => $uprice,
                        'user_id' => auth()->id(),
                        'status' => true,
                        'message' => 'ویرایش پروژه '.$project->title,
                        'model' => 'Project',
                        'model_id' => $project->id,
                    ]);
                    alert()->success('عملیات موفق !','پروژه شما با موفقیت ویرایش شد و در انتظار تایید مدیریت میباشد !');
                    return redirect()->back();
                }
            }else {
                alert()->success('عملیات موفق !', 'پروژه شما با موفقیت ویرایش شد و در انتظار تایید مدیریت میباشد !');
                return redirect()->back();
            }
        }
    }

    public function all()
    {
        $projects = Project::opens()->paginate(20);
        $page = 'پروژه های باز';
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        return view('User.Project.list',compact('projects','page'));
    }

    public function special()
    {
        $projects = Project::opens()->where('special',true)->paginate(20);
        $page = 'پروژه های ویژه';
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        return view('User.Project.list',compact('projects','page'));
    }

    public function search(Request $request)
    {
        $empty = true;
        $features = [];
        $projects = Project::opens();
        $page = 'جستجوی پروژه';
        if($request->title){
            $projects = $projects->whereIsLike('title',$request->title);
            $empty = false;
        }
        if($request->price_range){
            $projects = $projects->where('price_range',$request->price_range);
            $empty = false;
        }
        if($request->skill){
            $projects = $projects->whereHas("skills", function($q) use($request){
                $q->where("id",$request->id);
            });
            $empty = false;
        }
        if($request->features){
            $features = array_flip($request->features);
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
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        $projects = $projects->paginate(20);
        return view('User.Project.list',compact('projects','page','request'));
    }

    public function urgent()
    {
        $projects = Project::opens()->where('urgent',true)->paginate(20);
        $page = 'پروژه های فوری';
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        return view('User.Project.list',compact('projects','page'));
    }

    public function hire()
    {
        $projects = Project::opens()->where('hire',true)->paginate(20);
        $page = 'پروژه های استخدامی';
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        return view('User.Project.list',compact('projects','page'));
    }

    public function done()
    {
        $projects = Project::done()->paginate(20);
        return view('User.Project.done',compact('projects'));
    }

    public function related()
    {
        $projects = Project::where('status','open')->where('publish_status','open')->whereHas('skills', function (Builder $query) {
            $query->whereIn('skill_id',array_values(auth()->user()->skills()->pluck('skill_id')->toArray()));
        })->paginate(20);
        $page = 'پروژه های مرتبط با تخصص شما';
        // Checked this Out
        \user()->update([
            'checked_at' => now()
        ]);
        return view('User.Project.list',compact('projects','page'));
    }

    public function view(Project $project)
    {
        if(user()->id != $project->user->id || !user()->admin){
            if(!$project->is_paid || is_null($project->confirmed_at) || $project->publish_status == 'canceled'){
                return redirect(route('userDashboard'));
            }
            $project->increment('views');
        }
        return view('User.Project.view',compact('project'));
    }

    public function subcategory(Request $request)
    {
        if($request->ajax()){
            $cat = Category::whereId($request->id)->first();
            if($cat){
                if($cat->subcategories()->count()){
                    $data = [];
                    foreach ($cat->subcategories()->get() as $category){
                        $data[$category->id]['id'] = $category->id;
                        $data[$category->id]['name'] = $category->name;
                        $data[$category->id]['icon'] = $category->icon;
                    }
                    return response()->json(['status'=>true,'data'=>$data]);
                }else {
                    return response()->json(['status'=>true,'data'=>[]]);
                }
            }else {
                return response()->json(['status'=>false,'msg'=>'دسته مورد نظر وجود ندارد !']);
            }
        }
    }

    public function freelancerToEmployer(Project $project)
    {
        if($project->isEmployer()){
            return redirect(route('user.project.view',['project'=>$project->id]));
        }
        $page = 'fte';
        // Mark As Read
        $project->conversations()->us($project)->where('status','confirmed')->where('user_id','!=',user()->id)->update(['read'=>1]);
        return view('User.Project.conversations',compact('project','page'));
    }

    public function freelancerToEmployerStore(Project $project,Request $request)
    {
        // If Is Employer Of This Project Should Not Watch This Page
        if($project->isEmployer()){
            return redirect(route('user.project.view',['project'=>$project->id]));
        }
        if($request->price){
            // Check Request Validation
            $this->validate($request,[
                'warranty' => 'required|gte:'.$project->min_guarantee,
                'deadline' => 'required|lte:'.$project->deadline,
                'price' => 'required|gte:5000'
            ]);
            // If User Already Made an Offer
            if($offer = $project->offer()){
                // Update Offer
                $offer->update([
                    'price' => $request->price,
                    'deadline' => $request->deadline,
                    'warranty' => $request->warranty,
                    'prepayment' => $request->prepayment ?? $offer->prepayment,
                ]);
                // Notification
                Notification::create([
                    'text' => sprintf('کاربر %s  پیشنهاد خود را برای پروژه %s تغیر داد',\user()->name(),limit($project->title,30,'')),
                    'user_id' => $project->user->id,
                    'url' => $project->conversationLink(\user())
                ]);
                alert()->success('عملیات موفق !','پیشنهاد شما بروزرسانی شد !');
                return redirect($project->conversationLink());
            }else {
                $prepayment = $request->prepayment ?? 0;
                // Make an Offer
                $offer = $project->offers()->create([
                    'user_id' => user()->id,
                    'price' => $request->price,
                    'deadline' => $request->deadline,
                    'warranty' => $request->warranty,
                    'prepayment' => $prepayment,
                    'content' => scriptStripper($request->get('content'))
                ]);
                // Notify User
                Notification::create([
                    'text' => sprintf('پیشنهاد جدیدی برای پروژه %s ارسال شده',limit($project->title,30,'')),
                    'user_id' => $project->user->id,
                    'url' => $project->conversationLink(\user())
                ]);
                // If Is There Any File , So Upload Them
                if($request->file[0]){
                    $this->uploadFiles($request->file,$offer,'offer_id');
                }
                // If Already User Has Some Messages On This Project So Dont Send Offer Message As Project Message
                if(!$project->conversations()->us($project)->count()){
                    $conversation = $project->conversations()->create([
                        'user_id' => user()->id,
                        'target_id' => $project->user->id,
                        'message' => scriptStripper($request->get('content'))
                    ]);
                    if($request->file[0]){
                        $this->uploadFiles($request->file,$conversation,'conversation_id');
                    }
                }
                alert()->success('عملیات موفق !','پیشنهاد شما ثبت شد !');
                return redirect($project->conversationLink());
            }
        }else {
            // If There Is Content Key In Request Collection Copy it as "Message"
            if($request->get('content')){
                $request = $request->merge(['message' => $request->get('content')]);
            }
            $this->validate($request,[
                'message' => 'required|min:10'
            ]);
            if($request->deliver){
                $conversation = $project->conversations()->create([
                    'user_id' => user()->id,
                    'target_id' => $project->user->id,
                    'message' => scriptStripper($request->get('message')),
                    'done' => true
                ]);
                $project->update([
                    'status' => 'flc_done'
                ]);
                // Notify User
                Notification::create([
                    'text' => sprintf('مجری پروژه %s پروژه را تحویل داده',limit($project->title,30,'')),
                    'user_id' => $project->user->id,
                    'url' => $project->conversationLink(\user()) . '#msg' . $conversation->id
                ]);
                if($project->user->phone()){
                    sms($project->user->phone(),sprintf('مجری پروژه #%s کار را تحویل داده !',$project->id));
                }
            }else {
                $conversation = $project->conversations()->create([
                    'user_id' => user()->id,
                    'target_id' => $project->user->id,
                    'message' => scriptStripper($request->get('message')),
                    'status' => boolval(option('message_confirmation')) ? 'pending' : 'confirmed'
                ]);
                if(!boolval(option('message_confirmation')) ){
                    // Notify User
                    Notification::create([
                        'text' => sprintf('پیام جدیدی برای پروژه %s از طرف کاربر %s ارسال شده',limit($project->title,30,''),\user()->name()),
                        'user_id' => $project->user->id,
                        'url' => $project->conversationLink(\user()) . '#msg' . $conversation->id
                    ]);
                }
            }
            if($request->file[0]){
                $this->uploadFiles($request->file,$conversation,'conversation_id');
            }
            alert()->success('عملیات موفق !','پیام شما ارسال شد !');
            return redirect($project->conversationLink());
        }
    }

    public function freelancerToEmployerRemove(Project $project)
    {
        if($project->isEmployer()){
            return redirect(route('user.project.view',['project'=>$project->id]));
        }
        if(optional($project)->offer()){
            $project->offer()->delete();
            alert()->success('عملیات موفق','پیشنهاد شما حذف شد !');
            return redirect(route('user.project.view',['project'=>$project->id]));
        }else {
            alert()->warning('عملیات ناموفق','پیشنهادی برای حذف وجود ندارد !');
            return redirect(route('user.project.view',['project'=>$project->id]));
        }
    }

    public function employerToFreelancer(Project $project,User $user)
    {
        $this->ifIsEmployer($project);
        $page = 'etf';
        // Mark As Read
        $project->conversations()->us($project,$page == 'fte' ? null : $user)->where('status','confirmed')->where('user_id','!=',user()->id)->update(['read'=>1]);
        return view('User.Project.conversations',compact('project','page','user'));
    }

    public function employerToFreelancerStore(Project $project,User $user,Request $request)
    {
        $this->ifIsEmployer($project);
        $this->validate($request,[
            'message' => 'required|min:10'
        ]);
        $conversation = $project->conversations()->create([
            'user_id' => user()->id,
            'target_id' => $user->id,
            'message' => scriptStripper($request->get('message')),
            'status' => boolval(option('message_confirmation')) ? 'pending' : 'confirmed'
        ]);
        if($request->file[0]){
            $this->uploadFiles($request->file,$conversation,'conversation_id');
        }
        if(!boolval(option('message_confirmation'))){
            // Notify User
            Notification::create([
                'text' => sprintf('پیام جدیدی از پروژه %s ارسال شده',limit($project->title,30,'')),
                'user_id' => $user->id,
                'url' => $project->conversationLink() . '#msg' . $conversation->id
            ]);
        }
        alert()->success('عملیات موفق !','پیام شما ارسال شد !');
        return redirect($project->conversationLink($user));
    }

    private function uploadFiles($fileInput,$model,$key)
    {
        // Get the temporary path
        $filepond = app(Filepond::class);
        $files = $fileInput;
        if(is_iterable($files)){
            foreach ($files as $item){
                $path = $filepond->getPathFromServerId($item);
                $file = $path;
                $enc = md5(time());
                $finalLocation = "uploads/{$enc}{$file}";
                $from = '/filepond/temp/'.$file;
                $size = Storage::disk('upload')->size($from);
                $extArray = explode('.',$file);
                $ext = end($extArray);
                if(!in_array($ext,["7z","3gp","ai","asf","avi","bin","bmp","bz2","c","cpp","doc","docx","dwg","eot","epub","f","flv","gif","gz","html","ico","jar","jpg","jpeg","m4v","mdb","mkv","mov","mp4","mp4a","mp3","mpeg","mpga","odt","oga","ogg","ogv","p","pdf","png","ppt","pptx","psd","qt","rar","rtf","sql","svg","swf","tar","tiff","ttf","txt","vcf","wav","webm","webp","xls","xlsx","xml","xz","zip"])){
                    Storage::disk('upload')->delete($from);
                    continue;
                }
                Storage::disk('upload')->move($from, $finalLocation);
                File::create([
                    'user_id' => user()->id,
                    $key => $model->id,
                    'url' => $finalLocation,
                    'name' => $enc.$file,
                    'size' => $size,
                    'type' => $ext
                ]);
            }
        }
    }

    public function acceptOffer(Project $project,Offer $offer)
    {
        $this->ifIsEmployer($project);
        if($project->finalOffer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }
        $project->update(['offer_id'=>$offer->id,'freelancer_id'=>$offer->user->id]);
        // Notification
        Notification::create([
            'text' => sprintf('پیشنهاد شما در پروژه %s پذیرفته شد !',limit($project->title,30,'')),
            'user_id' => $offer->user->id,
            'url' => $project->conversationLink(),
            'type' => 'success'
        ]);
        if($offer->user->phone()){
            sms($offer->user()->phone(),sprintf('پیشنهاد شما در پروژه #%s پذیرفته شد !',$project->id));
        }
        // Employer Should Pay The Trust If There is Prepayment Trust Or Price Is Less than 1,000,000
        if(intval($project->finalOffer()->prepayment) > 0 || intval($project->finalOffer()->price) < 1000000){
            $project->update(['status'=>'emp_trust']);
            // Notification
            Notification::create([
                'text' => sprintf('شما باید در پروژه %s گروگزاری کنید',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => $project->conversationLink(\user()),
                'type' => 'warning'
            ]);
        }elseif (intval($project->finalOffer()->warranty) > 0){
            $project->update(['status'=>'flc_trust','starts_at'=>now()]);
            // Notification
            Notification::create([
                'text' => sprintf('شما باید در پروژه %s گروگزاری کنید',limit($project->title,30,'')),
                'user_id' => $offer->user->id,
                'url' => $project->conversationLink(),
                'type' => 'warning'
            ]);
        }else {
            $project->update(['status'=>'trust_done','starts_at'=>now()]);
        }
        alert()->success(sprintf('پیشنهاد %s با موفقیت تایید شد !',$project->freelancer->name()));
        return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
    }

    public function employerPrepayment(Project $project)
    {
        $this->ifIsEmployer($project);
        $offer = $project->finalOffer();
        $price = getPercent($offer->price,$offer->prepayment,true);
        if(auth()->user()->balance >= intval($price)){
            auth()->user()->update([
                'balance' => auth()->user()->balance - $price
            ]);
            option('earning',intval(option('earning')) + $price);
            // Create Payment
            Payment::create([
                'price' => $price,
                'user_id' => \user()->id,
                'status' => true,
                'message' => $project->title,
                'percent' => $offer->prepayment,
                'type' => 'deposit',
                'model' => 'Project',
                'model_id' => $project->id
            ]);
            // Notification
            Notification::create([
                'text' => sprintf('کارفرما گروگزاری پروژه %s رو انجام داد .',limit($project->title,30,'')),
                'user_id' => $project->freelancer->id,
                'url' => $project->conversationLink(),
                'type' => 'info'
            ]);
            if($project->freelancer->phone()){
                sms($project->freelancer->phone(),sprintf('کارفرما گروگزاری پروژه #%s را انجام داد !',$project->id));
            }
            if(intval($project->finalOffer()->warranty)){
                $project->update(['status'=>'flc_trust','starts_at'=>now()]);
                // Notification
                Notification::create([
                    'text' => sprintf('شما باید برای پروژه %s گروگزاری کنید !',limit($project->title,30,'')),
                    'user_id' => $project->freelancer->id,
                    'url' => $project->conversationLink(),
                    'type' => 'info'
                ]);
            }else {
                $project->update(['status'=>'trust_done','starts_at'=>now()]);
            }
            alert()->success('عملیات موفق','گروگزاری با موفقیت انجام شد !');
        }else {
            $shouldPay = $price - user()->balance;
            return redirect(route('money.pay',['amount'=>$shouldPay]));
        }

        return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
    }

    public function deposit(Project $project)
    {
        $this->ifIsEmployer($project);
        if($project->deposit == 100){
            alert()->warning('خطا!','شما قبلا مبلغ کل پروژه را گرو گزاری کردید !');
            return redirect($project->conversationLink($project->freelancer));
        }
        return view('User.Project.deposit',compact('project'));
    }

    public function close(Project $project)
    {
        $this->ifIsEmployer($project);
        if(in_array($project->status,['emp_trust','flc_trust','trust_done','flc_done','closed','ended'])){
            alert()->error('خطا!','امکان انجام این عملیات وجود ندارد !');
            return redirect($project->link());
        }
        $project->update([
            'status' => 'ended',
            'publish_status' => 'canceled'
        ]);
        alert()->warning('تبریک!','پروژه بسته شد و دیگر در لیست پروژه ها نمایش داده نمیشود !');
        return redirect($project->link());
    }

    public function depositAction(Project $project,Request $request)
    {
        $this->ifIsEmployer($project);
        if($project->deposit == 100){
            alert()->warning('خطا!','شما قبلا مبلغ کل پروژه را گرو گزاری کردید !');
            return redirect($project->conversationLink($project->freelancer));
        }
        $this->validate($request,[
            'deposit' => 'required|lte:' . (100 - intval($project->finalOffer()->prepayment))
        ]);
        $offer = $project->finalOffer();
        $price = getPercent($offer->price,intval($request->deposit),true);
        if(auth()->user()->balance >= intval($price)){
            auth()->user()->update([
                'balance' => auth()->user()->balance - $price
            ]);
            option('earning',intval(option('earning')) + $price);
            // Payment
            Payment::create([
                'price' => $price,
                'user_id' => \user()->id,
                'status' => true,
                'message' => $project->title,
                'percent' => intval($request->deposit),
                'type' => 'deposit',
                'model' => 'Project',
                'model_id' => $project->id
            ]);
            $project->update([
                'deposit' => intval($project->deposit) + intval($request->deposit)
            ]);
            // Notification
            Notification::create([
                'text' => sprintf('کارفرما %s درصد از گروگزاری پروژه %s رو انجام داد .',intval($request->deposit),limit($project->title,30,'')),
                'user_id' => $project->freelancer->id,
                'url' => $project->conversationLink(),
                'type' => 'info'
            ]);
            if($project->freelancer->phone()){
                sms($project->freelancer->phone(),sprintf('کارفرما  %s درصد  از گروگزاری پروژه #%s را انجام داد !',intval($request->deposit),$project->id));
            }
            alert()->success('عملیات موفق','گروگزاری با موفقیت انجام شد !');
        }else {
            $shouldPay = $price - user()->balance;
            return redirect(route('money.pay',['amount'=>$shouldPay]));
        }
        return redirect($project->conversationLink($project->freelancer));
    }

    public function freelancerWarranty(Project $project)
    {
        $this->ifIsFreelancer($project);
        $offer = $project->finalOffer();
        $price = getPercent($offer->price,$offer->warranty,true);
        if(auth()->user()->balance >= intval($price)){
            auth()->user()->update([
                'balance' => auth()->user()->balance - $price
            ]);
            option('earning',intval(option('earning')) + $price);
            Payment::create([
                'price' => $price,
                'user_id' => \user()->id,
                'status' => true,
                'message' => $project->title,
                'percent' => $offer->warranty,
                'type' => 'deposit',
                'model' => 'Project',
                'model_id' => $project->id
            ]);
            // Notification
            Notification::create([
                'text' => sprintf('مجری گروگزاری پروژه %s را انجام داد !',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]),
                'type' => 'info'
            ]);
            if($project->user->phone()){
                sms($project->user->phone(),sprintf('مجری گروگزاری پروژه #%s را انجام داد !',$project->id));
            }
            $project->update([
                'status' => 'trust_done'
            ]);
            alert()->success('عملیات موفق',"گروگزاری با موفقیت انجام شد !\n حال باید شروع به کار کنید !");
        }else {
            // payment
        }
        return redirect($project->conversationLink());
    }

    private function ifIsEmployer(Project $project,$ifItsNot=false)
    {
        if(!$ifItsNot){
            if(!$project->isEmployer()){
                return redirect(route('user.project.view',['project'=>$project->id]));
            }
        }else {
            if($project->isEmployer()){
                return redirect(route('user.project.view',['project'=>$project->id]));
            }
        }
    }

    private function ifIsFreelancer(Project $project,$ifItsNot=false)
    {
        if(!$ifItsNot){
            if(!$project->isFreelancer()){
                return redirect(route('user.project.view',['project'=>$project->id]));
            }
        }else {
            if($project->isFreelancer()){
                return redirect(route('user.project.view',['project'=>$project->id]));
            }
        }
    }

    public function convertHire(Project $project)
    {
        $this->ifIsEmployer($project);
        if(!$project->hire){
            $price = intval(option('hire'));
            if(auth()->user()->balance($price)){
                auth()->user()->balance($price,"-");
                option('earning',intval(option('earning')) + $price);
                option('site',intval(option('site')) + $price);
                Payment::create([
                    'price' => $price,
                    'user_id' => \user()->id,
                    'status' => true,
                    'message' => sprintf('تبدیل پروژه %s به استخدامی !',limit($project->title,20)),
                    'model' => 'Project',
                    'model_id' => $project->id
                ]);
                $project->update(['hire'=>true]);
                alert()->success('عملیات موفق',"آگهی شما به استخدامی تبدیل شد !");
            }else {
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }
            if($project->freelancer()->count()){
                // Notification
                Notification::create([
                    'text' => sprintf('کارفرما پروژه %s را به آگهی استخدام تبدیل کرد !',limit($project->title,30,'')),
                    'user_id' => $project->freelancer->id,
                    'url' => route('conversations.fte',['project' => $project->id]),
                    'type' => 'success'
                ]);
            }
            // Notification
            Notification::create([
                'text' => sprintf('پروژه %s به آگهی استخدامی تبدیل شد !',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => route('user.project.view',['project' => $project->id]),
                'type' => 'success'
            ]);
        }else {
            $project->update(['hire'=>true]);
            alert()->error('عملیات ناموفق',"آگهی شما هم اکنون در دسته استخدامی است !");
        }
        if($project->freelancer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }else {
            return redirect(route('user.project.view',['project' => $project->id]));
        }
    }

    public function convertUrgent(Project $project)
    {
        $this->ifIsEmployer($project);
        if(!$project->urgent){
            $price = intval(option('urgent'));
            if(auth()->user()->balance($price)){
                auth()->user()->balance($price,"-");
                option('earning',intval(option('earning')) + $price);
                option('site',intval(option('site')) + $price);
                Payment::create([
                    'price' => $price,
                    'user_id' => \user()->id,
                    'status' => true,
                    'message' => sprintf('تبدیل پروژه %s به فوری !',limit($project->title,20)),
                    'model' => 'Project',
                    'model_id' => $project->id
                ]);
                $project->update(['urgent'=>true]);
                alert()->success('عملیات موفق',"آگهی شما به فوری تبدیل شد !");
            }else {
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }
            // Notification
            Notification::create([
                'text' => sprintf('پروژه %s به آگهی فوری تبدیل شد !',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => route('user.project.view',['project' => $project->id]),
                'type' => 'success'
            ]);
        }else {
            $project->update(['hire'=>true]);
            alert()->error('عملیات ناموفق',"آگهی شما هم اکنون در دسته استخدامی است !");
        }
        if($project->freelancer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }else {
            return redirect(route('user.project.view',['project' => $project->id]));
        }
    }

    public function convertHidden(Project $project)
    {
        $this->ifIsEmployer($project);
        if(!$project->hidden){
            $price = intval(option('hidden'));
            if(auth()->user()->balance($price)){
                auth()->user()->balance($price,"-");
                option('earning',intval(option('earning')) + $price);
                option('site',intval(option('site')) + $price);
                Payment::create([
                    'price' => $price,
                    'user_id' => \user()->id,
                    'status' => true,
                    'message' => sprintf('تبدیل پروژه %s به پروژه مخفی !',limit($project->title,20)),
                    'model' => 'Project',
                    'model_id' => $project->id
                ]);
                $project->update(['hidden'=>true]);
                alert()->success('عملیات موفق',"آگهی شما از دید گوگل مخفی شد !");
            }else {
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }
            // Notification
            Notification::create([
                'text' => sprintf('پروژه %s از دید گوگل مخفی شد !',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => route('user.project.view',['project' => $project->id]),
                'type' => 'success'
            ]);
        }else {
            $project->update(['hidden'=>true]);
            alert()->error('عملیات ناموفق',"آگهی شما هم اکنون از دید گوگل مخفی است !");
        }
        if($project->freelancer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }else {
            return redirect(route('user.project.view',['project' => $project->id]));
        }
    }

    public function convertSpecial(Project $project)
    {
        $this->ifIsEmployer($project);
        if(!$project->special){
            $price = intval(option('special'));
            if(auth()->user()->balance($price)){
                auth()->user()->balance($price,"-");
                option('earning',intval(option('earning')) + $price);
                option('site',intval(option('site')) + $price);
                Payment::create([
                    'price' => $price,
                    'user_id' => \user()->id,
                    'status' => true,
                    'message' => sprintf('تبدیل پروژه %s به پروژه ویژه !',limit($project->title,20)),
                    'model' => 'Project',
                    'model_id' => $project->id
                ]);
                $project->update(['special'=>true]);
                alert()->success('عملیات موفق',"آگهی شما در لیست ویژه قرار گرفت !");
            }else {
                $shouldPay = $price - user()->balance;
                return redirect(route('money.pay',['amount'=>$shouldPay]));
            }
            // Notification
            Notification::create([
                'text' => sprintf('پروژه %s در لیست ویژه قرار گرفت !',limit($project->title,30,'')),
                'user_id' => $project->user->id,
                'url' => route('user.project.view',['project' => $project->id]),
                'type' => 'success'
            ]);
        }else {
            $project->update(['special'=>true]);
            alert()->error('عملیات ناموفق',"آگهی شما هم اکنون لیست ویژه است !");
        }
        if($project->freelancer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }else {
            return redirect(route('user.project.view',['project' => $project->id]));
        }
    }

    public function confirm(Project $project)
    {
        $this->ifIsEmployer($project);
        if(in_array($project->status,['flc_done','trust_done'])){
            if($project->deposit != 100){
                alert()->warning('عملیات ناموفق !',"برای پایان کار باید ابتدا گروگزاری پروژه رو کامل کنید !");
                return redirect()->route('user.project.deposits',['project'=>$project->id]);
            }
            // Calculate How Much Should Freelancer Get
            $fee = intval($project->freelancer->package()->features->fee);
            $wholePrice = $project->finalOffer()->price;
            $WhatIsReleased = $project->released;
            $whatIsShouldPay = 100 - $WhatIsReleased;
            $percent = $whatIsShouldPay;
            $whatIsShouldPay -= $fee;
            if($project->finalOffer()->warranty){
                $whatIsShouldPay += intval($project->finalOffer()->warranty);
            }
            $WhatsLeftForFreelancer = getPercent($wholePrice,$whatIsShouldPay);
            $project->freelancer->balance($WhatsLeftForFreelancer,'+');
            // Calculate Fee
            $firstFee = intval(option('first_fee'));
            $normalFee = intval(option('normal_fee'));
            if(\user()->inviter()->count()){
                $isMorethan1Year = jdate(\user()->created_at)->addDays(365)->getTimestamp() >= now()->timestamp;
                if(\user()->fee_times <= intval(option('fee_times')) && $isMorethan1Year){
                    $finalFee = $normalFee;
                    if(!user()->first_project){
                        $finalFee = $firstFee;
                    }
                    $finalFee /= 10;
                    $fee -= $finalFee;
                    $parentPaid = getPercent($wholePrice,$finalFee,true);
                    \user()->inviter()->balance($parentPaid,'+');
                    Notification::create([
                        'text' => sprintf('شما مبلغ %s از پروژه کاربر %s سود معرف دریافت کردید !',money($parentPaid),\user()->nicky),
                        'user_id' => \user()->inviter->id,
                        'url' => route('money.index'),
                        'type' => 'success'
                    ]);
                    \user()->update([
                        'fee_times' => \user()->fee_times + 1,
                        'first_project' => true
                    ]);
                }
            }
            // Calculate Fee
            $sitePaid = getPercent($wholePrice,$fee,true);
            option('earning',intval(option('earning')) + $sitePaid);
            option('projectsFee',intval(option('projectsFee')) + $sitePaid);
            Payment::create([
                'price' => $WhatsLeftForFreelancer,
                'user_id' => $project->freelancer->id,
                'status' => true,
                'message' => $project->title,
                'model' => 'Project',
                'model_id' => $project->id,
                'type' => 'release',
                'percent' => $percent
            ]);
            $project->update(['status'=>'closed','released'=>'100','publish_status'=>'closed']);
            // Notification
            Notification::create([
                'text' => sprintf('وجه پروژه %s کاملا آزاد سازی شد و پروژه توسط خریدار تایید شد !',limit($project->title,20,'')),
                'user_id' => $project->freelancer->id,
                'url' => route('user.project.view',['project' => $project->id]),
                'type' => 'success'
            ]);
            if($project->freelancer->phone()){
                sms($project->freelancer->phone(),sprintf('پروژه #%s پایان یافت و وجه آن کاملا آزاد سازی شد !',$project->id));
            }
        }else {
            $project->update(['special'=>true]);
            alert()->error('عملیات ناموفق',"در حال حاضر امکان تایید پروژه مجری رو ندارید !");
        }
        if($project->freelancer()->count()){
            return redirect(route('conversations.etf',['project' => $project->id,'user'=>$project->freelancer->id]));
        }else {
            return redirect(route('user.project.view',['project' => $project->id]));
        }
    }

    public function release(Project $project)
    {
        $this->ifIsEmployer($project);
        if($project->released == 100){
            alert()->warning('خطا!','شما قبلا مبلغ کل پروژه را آزاد سازی کردید !');
            return redirect($project->conversationLink($project->freelancer));
        }
        return view('User.Project.release',compact('project'));
    }

    public function releaseAction(Project $project,Request $request)
    {
        $this->ifIsEmployer($project);
        if($project->released == 100){
            alert()->warning('خطا!','شما قبلا مبلغ کل پروژه را آزادسازی کردید !');
            return redirect($project->conversationLink($project->freelancer));
        }
        $this->validate($request,[
            'release' => 'required|lte:' . ($project->deposit - intval($project->finalOffer()->prepayment))
        ]);
        $offer = $project->finalOffer();
        $price = getPercent($offer->price,intval($request->release),true);
        $fee = intval($project->freelancer->package()->features->fee);
        $price = getPercent($price,$fee);
        $project->freelancer->balance($price,'+');
        $sitePaid = getPercent($price,$fee,true);
        option('earning',intval(option('earning')) + $sitePaid);
        option('projectsFee',intval(option('projectsFee')) + $sitePaid);
        Payment::create([
            'price' => $price,
            'user_id' => $project->freelancer->id,
            'status' => true,
            'message' => $project->title,
            'model' => 'Project',
            'model_id' => $project->id,
            'type' => 'release',
            'percent' => intval($request->release)
        ]);
        $project->update([
            'released' => intval($project->released) + intval($request->release)
        ]);
        // Notification
        Notification::create([
            'text' => sprintf('کارفرما %s درصد از مبلغ پروژه %s  را آزاد سازی کرد .',intval($request->release),limit($project->title,30,'')),
            'user_id' => $project->freelancer->id,
            'url' => $project->conversationLink(),
            'type' => 'info'
        ]);
        if($project->freelancer->phone()){
            sms($project->freelancer->phone(),sprintf('کارفرما %s درصد از مبلغ پروژه #%s  را آزاد سازی کرد .',intval($request->release),$project->id));
        }
        alert()->success('عملیات موفق','آزاد سازی با موفقیت انجام شد !');
        return redirect($project->conversationLink($project->freelancer));
    }

    public function vote(Project $project,Request $request)
    {
        if($project->isFreelancer()){
            $this->validate($request,[
                'point' => 'required|lte:10',
                'comment' => 'required|min:10'
            ]);
            $project->update([
                'employer_score' => intval($request->point),
                'employer_comment' => strip_tags($request->comment)
            ]);
            $rawPoints = (intval($request->point) * 10) + $project->user->raw_points;
            $project->user()->update([
                'raw_points' => $rawPoints,
                'points' => $rawPoints / ($project->user->doneProjects() * 10)
            ]);
            alert()->success('تبریک','امتیاز شما با موفقیت ثبت شد !');
            return redirect()->route('user.project.view',['project'=>$project->id]);
        }elseif ($project->isEmployer()){
            $this->validate($request,[
                'point' => 'required|lte:10',
                'comment' => 'required|min:10'
            ]);
            $project->update([
                'freelancer_score' => intval($request->point),
                'freelancer_comment' => strip_tags($request->comment)
            ]);
            $rawPoints = (intval($request->point) * 10) + $project->freelancer()->first()->raw_points;
            $project->freelancer()->first()->update([
                'raw_points' => $rawPoints,
                'points' => $rawPoints / ($project->freelancer()->first()->doneJobs() * 10)
            ]);
            alert()->success('تبریک','امتیاز شما با موفقیت ثبت شد !');
            return redirect()->route('user.project.view',['project'=>$project->id]);
        }else {
            alert()->error('خطا','شما اجازه دسترسی به این صفحه رو ندارید !');
            return redirect()->route('user.project.view',['project'=>$project->id]);
        }
    }
}
