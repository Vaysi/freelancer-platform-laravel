<?php

namespace App\Http\Controllers\User;

use App\Document;
use App\Events\newChatMessage;
use App\File;
use App\Message;
use App\Notification;
use App\Portfolio;
use App\Project;
use App\Question;
use App\Skill;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Itsdp\FilepondServer\Filepond;

class UserController extends Controller
{
    public function index()
    {
        $related = Project::where('status','open')->where('publish_status','open')->whereHas('skills', function (Builder $query) {
            $query->whereIn('skill_id',array_values(auth()->user()->skills()->pluck('skill_id')->toArray()));
        })->paginate(7);
        $specials = Project::opens()->where('urgent',true)->orWhere('special',true)->orWhere('sticky',true)->orderBy('sticky')->paginate(7);
        return view('User.index',compact('specials','related'));
    }

    public function rules()
    {
        return view('User.Pages.rules');
    }

    public function faq()
    {
        return view('User.Pages.faq');
    }

    public function help()
    {
        return view('User.Pages.help');
    }

    public function helpSingle($id)
    {
        $question = Question::whereId(intval($id))->firstOrFail();
        $title = $question->title;
        $content = $question->content;
        return view('User.Pages.page',compact('title','content'));
    }

    public function about()
    {
        return view('User.Pages.about');
    }

    public function profile()
    {
        return view('User.Profile.index');
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'name' => 'required'
        ]);
        if (Hash::check($request->password, auth()->user()->getAuthPassword())) {
            auth()->user()->update([
                'name' => $request->name
            ]);
            alert()->success('عملیات موفق', 'اطلاعات شما بروزرسانی شد !');
        } else {
            alert()->error('عملیات نا موفق', 'رمز فعلی نادرست است !');
        }
        return redirect()->route('profile');
    }

    public function password()
    {
        return view('User.Profile.password');
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|different:current_password|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);
        if (Hash::check($request->current_password, auth()->user()->getAuthPassword())) {
            auth()->user()->update([
                'password' => bcrypt($request->password)
            ]);
            alert()->success('عملیات موفق', 'رمز حساب شما بروزرسانی شد !');
            // Notification
            Notification::create([
                'text' => "رمز عبور شما بروزرسانی شد !",
                'user_id' => auth()->id(),
                'url' => route('password.change'),
                'type' => 'warning'
            ]);
        } else {
            alert()->error('عملیات نا موفق', 'رمز فعلی نادرست است !');
            // Notification
            Notification::create([
                'text' => "تلاش ناموفقی برای تغیر رمز عبور شما انجام شده !",
                'user_id' => auth()->id(),
                'url' => route('password.change'),
                'type' => 'danger'
            ]);
        }
        return redirect()->route('password.change');
    }

    public function avatar()
    {
        return view('User.Profile.avatar');
    }

    public function resumeEdit()
    {
        return view('User.Pages.resume');
    }

    public function resumeUpdate(Request $request)
    {
        $info = scriptStripper($request->info);
        $skills = array_slice(array_unique($request->skills), 0, 8);
        user()->update([
            'info' => $info,
            'nickname' => $request->nickname
        ]);
        foreach ($skills as $skill) {
            $user = Skill::find($skill);
            user()->skills()->save($user);
        }
        alert()->success('عملیات موفق', 'تغیرات شما با موفقیت ذخیره شد !');
        return redirect(route('resume.edit'));
    }

    public function document()
    {
        return view('User.Pages.document');
    }

    public function notifications()
    {
        return view('User.Pages.notifications');
    }

    public function resume()
    {
        $user = user();
        return view('User.Pages.resumeView', compact('user'));
    }

    public function userResume(User $user)
    {
        return view('User.Pages.resumeView', compact('user'));
    }

    public function download($id)
    {
        $file = File::whereId(decrypt($id))->first() ?? abort(404);
        $production = env('APP_ENV') == 'local' ? false : true;
        $url = public_path(($production ? '../' : '') . 'uploads/' . $file->name);
        return response()->download($url, "{$file->id}.{$file->type}");
    }

    public function viewNotification(Notification $notification)
    {
        $notification->update(['read' => 1]);
        return redirect($notification->url);
    }

    public function invite(User $user)
    {
        if($user->id == user()->id){
            alert()->error('خطا!','شما نمیتوانید از خودتان دعوت به همکاری کنید !');
            return redirect()->route('userDashboard');
        }
        return view('User.pages.invite', compact('user'));
    }

    public function inviteFor(Project $project)
    {
        $users = User::orderBy('score')->orderBy('updated_at')->paginate(25);
        $render = $users->render();
        $users = $users->sortByDesc(function ($product){
            return $product->allJobs();
        })->sortByDesc(function ($product){
            return $product->points;
        });
        return view('User.pages.inviteTo', compact('project','users','render'));
    }

    public function inviteIt(User $user, Project $project)
    {
        if ($project->isUserInvited($user)) {
            alert()->warning('خطا !', 'این کاربر قبلا به این پروژه دعوت شده است !');
            return redirect()->route('invite.user', ['user' => $user->id]);
        } else {
            $project->invites()->create([
                'user_id' => $user->id
            ]);
            Notification::create([
                'text' => sprintf('شما به پروژه %s دعوت شدید !', limit($project->title, 30, '')),
                'user_id' => $user->id,
                'url' => $project->link(),
                'type' => 'success'
            ]);
            alert()->success('عملیات موفق !', sprintf('این کاربر به پروژه %s دعوت شد !', limit($project->title, 30, '')));
            return redirect()->route('invite.user', ['user' => $user->id]);
        }
    }

    public function avatarUpdate(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,bmp,png,svg'
        ]);
        try {
            $name = $this->uploadFile($request, 'avatar', 'avatars', 200);
            \user()->update(['avatar' => $name]);
            alert()->success('عملیات موفق !', "آواتار شما تغیر کرد !");
        } catch (\Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getFile() . " in line " . $e->getLine());
            alert()->error('عملیات نا موفق !', 'خطایی در سیستم پیش آمده !');
        }
        return redirect()->route('avatar');
    }

    public function chatFirst()
    {
        $projecets = auth()->user()->lastConversations(true)->take(25);
        return $projecets;
    }

    public function chatSecond()
    {
        return auth()
            ->user()
            ->chatMessages()
            ->where(function ($query) {
                $query->bySender(request()->input('sender_id'))
                    ->byReceiver(auth()->user()->id);
            })
            ->orWhere(function ($query) {
                $query->bySender(auth()->user()->id)
                    ->byReceiver(request()->input('sender_id'));
            })
            ->get();
    }

    public function chatThird(Request $request)
    {
        $message = Message::create([
            'user_id'   => $request->input('sender_id'),
            'target_id' => $request->input('receiver_id'),
            'content'     => $request->input('message'),
            'project_id' => $request->input('project_id') ?? 0
        ]);
        broadcast(new newChatMessage($message));

        return $message->fresh();
    }

    public function chatFourth(Request $request)
    {
        \user()->update([
            'is_online' => boolval($request->input('online'))
        ]);
    }

    public function chatFifth(Request $request)
    {
        if($request->has('id')){
            $message = Message::find($request->id)->update([
                'read' => true
            ]);
        }else {
            $message = Message::where('user_id',$request->user_id)->where('target_id',auth()->id())->update([
                'read' => true
            ]);
        }
        return $message;
    }

    public function portfolioCreate()
    {
        return view('User.Portfolio.create');
    }

    public function portfolio()
    {
        $portfolios = \user()->portfolios()->latest()->get();
        return view('User.Portfolio.index',compact('portfolios'));
    }

    public function portfolioStore(Request $request)
    {
        if(user()->portfolios()->count() < intval(user()->package()->features->portfolio) || user()->package()->features->portfolio == '-1'){
            $this->validate($request,[
                'file' => 'required',
                'title' => 'required',
                'description' => 'max:1999',
                'skills' => 'required',
            ]);
            // Upload Files
            $images = $this->uploadFiles($request->file);
            if(is_string($images)){
                alert()->error('خطا !',$images);
                return redirect()->back();
            }
            $draft = $request->has('draft') ? 1 : 0;
            $portfolio = Portfolio::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id'=> \user()->id,
                'images' => $images,
                'draft' => $draft
            ]);
            $items = array_slice(array_unique($request->skills), 0, 8);
            foreach ($items as $skill){
                $ski = Skill::find($skill);
                $portfolio->skills()->save($ski);
            }
            alert()->success('تبریک !','نمونه کار شما ثبت شد و پس از تایید ناظر نمایش خواهد داده شد !');
            return redirect()->route('portfolio.index');
        }else {
            alert()->error('خطا !','برای ثبت نمونه کارهای بیشتر باید حساب کاربری خود را ارتقا دهید !');
            return redirect()->back();
        }
    }

    public function portfolioUpdate(Portfolio $portfolio,Request $request)
    {
        if($portfolio->user->id != \user()->id){
            alert()->error('خطا !','شما اجازه دسترسی به این صفحه رو ندارید');
            return redirect()->route('portfolio.index');
        }
        $this->validate($request,[
            'title' => 'required',
            'description' => 'max:1999',
            'skills' => 'required',
        ]);
        // Upload Files
        if($request->has('file')){
            $images = $this->uploadFiles($request->file,false);
            $realImages = $portfolio->images;
            if(is_string($images)){
                alert()->error('خطا !',$images);
                return redirect()->back();
            }
            foreach ($images as $image){
                $realImages[] = $image;
            }
        }
        $draft = $request->has('draft') ? 1 : 0;
        $portfolio->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id'=> \user()->id,
            'images' => $realImages ?? $portfolio->images,
            'draft' => $draft,
            'status' => "pending"
        ]);
        $items = array_slice(array_unique($request->skills), 0, 8);
        $portfolio->skills()->detach();
        foreach ($items as $skill){
            $ski = Skill::find($skill);
            $portfolio->skills()->save($ski);
        }
        alert()->success('تبریک !','نمونه کار شما بروزرسانی شد و پس از تایید ناظر نمایش خواهد داده شد !');
        return redirect()->route('portfolio.index');
    }

    private function uploadFiles($fileInput,$createThumbnail=true)
    {
        // Get the temporary path
        $filepond = app(Filepond::class);
        $files = $fileInput;
        $rFiles = [];
        if(is_iterable($files)){
            foreach ($files as $item){
                $path = $filepond->getPathFromServerId($item);
                $file = $path;
                $enc = md5(time());
                $finalLocation = "uploads/portfolios/{$enc}{$file}";
                $from = '/filepond/temp/'.$file;
                $image = Image::make(Storage::disk('upload')->get($from));
                $size = Storage::disk('upload')->size($from);
                $extArray = explode('.',$file);
                $ext = end($extArray);
                if(!in_array($ext,["jpg","jpeg","png","gif"]) || $size > 64000000 || ($image->width() < 750 || $image->width() > 4680) || ($image->height() < 750 || $image->height() > 4680)){
                    Storage::disk('upload')->delete($from);
                    if($image->width() < 750 || $image->width() > 4680 || $image->height() < 750 || $image->height() > 4680){
                        return 'حداکثر ارتفاع و طول عکس 4680px و حداقل آن 750px باید باشد !';
                    }else {
                        return 'فرمت یا اندازه فایل غیر مجاز است !';
                    }
                }
                if($createThumbnail){
                    if($item == $files[0]){
                        $second = $image->crop(750,750);
                        $rFiles[] = "uploads/portfolios/{$enc}_thumb_{$file}";
                        Storage::disk('upload')->put("uploads/portfolios/{$enc}_thumb_{$file}",(string)$second->encode());
                    }
                }
                Storage::disk('upload')->move($from, $finalLocation);
                $rFiles[] = $finalLocation;
            }
        }
        return $rFiles;
    }

    public function portfolioView(Portfolio $portfolio)
    {
        if(\user()->id != $portfolio->user->id){
            $portfolio->increment('views');
        }
        return view('User.Portfolio.show',compact('portfolio'));
    }

    public function portfolioLike(Portfolio $portfolio)
    {
        if($portfolio->isLiked()){
            $portfolio->decrement('liked');
            $portfolio->likes()->whereUserId(\user()->id)->delete();
        }else {
            $portfolio->increment('liked');
            $portfolio->likes()->create([
                'user_id' => \user()->id
            ]);
        }
        return response()->json([
            'liked' => $portfolio->liked,
            'isLiked' => $portfolio->isLiked()
        ]);
    }

    public function portfolioEdit(Portfolio $portfolio)
    {
        if($portfolio->user->id != \user()->id){
            alert()->error('خطا !','شما اجازه دسترسی به این صفحه رو ندارید');
            return redirect()->route('portfolio.index');
        }
        return view('User.Portfolio.edit',compact('portfolio'));
    }

    public function portfolioRemoveImage(Portfolio $portfolio,Request $request)
    {
        if($portfolio->user->id != \user()->id){
            alert()->error('خطا !','شما اجازه دسترسی به این صفحه رو ندارید');
            return redirect()->route('portfolio.index');
        }
        $images = $portfolio->withoutThumb();
        $path = decrypt($request->id);
        if(in_array($path,$images)){
            if(count($images) < 2){
                return response()->json([
                    'status' => 0,
                    'msg' => 'این تنها عکس این نمونه کار هست , برای پاک کردن ابتدا عکس دیگری اضافه کنید !'
                ]);
            }
            Storage::disk('upload')->delete($path);
            $index = array_search($path,$portfolio->images);
            $r = $portfolio->images;
            unset($r[$index]);
            $portfolio->update([
                'images' => $r
            ]);
            return response()->json([
                'status' => true,
                'msg' => 'با موفقیت حذف شد !'
            ]);
        }else {
            return response()->json([
                'status' => 0,
                'msg' => 'عکس مورد نظر وجود ندارد !'
            ]);
        }
    }

    public function documentStore(Request $request)
    {
        if($request->hasFile('file')){
            $url= $this->uploadFile($request, 'file', 'documents');
            \user()->documents()->create([
                'url' => $url
            ]);
            alert()->success('تبریک !','تصویر با موفقیت آپلود شد و در صف انتظار قرار گرفت !');
            return redirect()->route('document.upload');
        }else {
            alert()->error('خطا !','باید تصویری را آپلود کنید !');
            return redirect()->route('document.upload');
        }
    }

    public function phoneVerify(Request $request)
    {
        if($request->phone){
            if(preg_match("/(\+98|0)?9\d{9}/",$request->phone)){
                user()->update([
                    'phone' => $request->phone
                ]);
                $code = rand(10000,99999);
                sms($request->phone,'',[
                    'pattern' => 246,
                    'input' => [
                        'code' => $code,
                        'app_name' => 'پروژستان'
                    ]
                ]);
                Session::put('verify.'.\user()->id,$code);
                return response()->json([
                    'status' => 1,
                    'msg' => 'با موفقیت ارسال شد !'
                ]);
            }
        }else {
            return response()->json([
                'status' => 0,
                'msg' => 'وارد کردن شماره تلفن ضروری است !'
            ]);
        }
    }

    public function phoneVerifyCode(Request $request)
    {
        if($request->code){
            $code = Session::get('verify.'.\user()->id);
            if($request->code == $code){
                user()->update([
                    'phone_verified_at' => now()
                ]);
                return response()->json([
                    'status' => 1,
                    'msg' => 'شماره موبایل شما تایید شد !'
                ]);
            }else {
                return response()->json([
                    'status' => 0,
                    'msg' => 'کد وارد شده صحیح نمیباشد !'
                ]);
            }
        }else {
            return response()->json([
                'status' => 0,
                'msg' => 'وارد کردن کد ضروری است !'
            ]);
        }
    }
}
