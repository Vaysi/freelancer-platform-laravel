<?php

use GuzzleHttp\Client;
use Illuminate\Support\Str;

if (!function_exists('user')) {
    function user()
    {
        return auth()->check() ? auth()->user() : optional();
    }
}

if (!function_exists('limit')) {
    function limit($value, $limit = 100, $end = '...')
    {
        return Str::limit(str_replace("<br>","",$value),$limit,$end);
    }
}

if (!function_exists('money')) {
    function money(int $val,$echo=true)
    {
        if($echo){
            return number_format($val,null,'.',',') . " تومان ";
        }else {
            return number_format($val,null,'.',',');
        }
    }
}

if (!function_exists('project_status')) {
    function project_status($project,$badge=true,$percentage=false)
    {
        if($percentage == true){
            if(!$project->is_paid){
                return '0';
            }elseif($project->status == "emp_trust"){
                return '50';
            }elseif($project->status == "flc_trust"){
                return '65';
            }elseif($project->status == "closed") {
                return '100';
            }elseif($project->status == "ended") {
                return '0';
            }elseif($project->status == "trust_done") {
                return '75';
            }elseif($project->status == "flc_done") {
                return '85';
            }elseif($project->isExpired()){
                return '0';
            }elseif($project->status == "open") {
                return '35';
            }else{
                return '0';
            }
        }
        if($badge){
            if($project->status == "flc_done") {
                return '<span class="badge badge-info">مجری تحویل داده</span>';
            }elseif(!$project->is_paid) {
                return '<span class="badge badge-danger">در انتظار پرداخت</span>';
            }elseif($project->status == "emp_trust"){
                return '<span class="badge badge-warning">در انتظار گروگزاری کارفرما</span>';
            }elseif($project->status == "flc_trust"){
                return '<span class="badge badge-warning">در انتظار گروگزاری مجری</span>';
            }elseif($project->status == "closed") {
                return '<span class="badge badge-success">پایان یافته</span>';
            }elseif($project->status == "ended") {
                return '<span class="badge badge-success">لغو شده</span>';
            }elseif($project->status == "trust_done") {
                return '<span class="badge badge-info">در حال انجام</span>';
            }elseif($project->isExpired()){
                return '<span class="badge badge-danger">زمان مناقصه پایان یافته</span>';
            }elseif($project->status == "open"){
                return '<span class="badge badge-info">آماده دریافت پیشنهادات</span>';
            }else{
                return '<span class="badge badge-primary">در حال انجام</span>';
            }
        }else {
            if(!$project->is_paid) {
                return 'در انتظار پرداخت';
            }elseif($project->status == "emp_trust"){
                return 'در انتظار گروگزاری کارفرما';
            }elseif($project->status == "flc_trust"){
                return 'در انتظار گروگزاری مجری';
            }elseif($project->status == "closed") {
                return 'پروژه توسط خریدار تایید شده';
            }elseif($project->status == "ended") {
                return 'لغو شده';
            }elseif($project->status == "flc_done") {
                return 'مجری تحویل داده';
            }elseif($project->isExpired()){
                return 'زمان مناقصه پایان یافته';
            }elseif($project->status == "open") {
                return 'آماده دریافت پیشنهادات';
            }elseif($project->status == "trust_done") {
                return 'در حال انجام';
            }else{
                return 'در حال انجام';
            }
        }
    }
}

if (!function_exists('project_tags')) {
    function project_tags($project,$return=false,$bg=true)
    {
        if($return){
            if($project->sticky){
                return 'اولویت بالا';
            }elseif($project->private) {
                return 'خصوصی';
            }elseif($project->urgent) {
                return 'فوری';
            }elseif($project->hire) {
                return 'استخدامی';
            }elseif($project->special) {
                return 'ویژه';
            }elseif($project->hidden) {
                return 'مخفی';
            }
        }else {
            $r = '';
            if($project->sticky){
                $r .= 'sticky' . ($bg ? ' sticky-bg' : '');
            }elseif($project->private) {
                $r .= 'private' . ($bg ? ' private-bg' : '');
            }elseif($project->urgent) {
                $r .= 'urgent' . ($bg ? ' urgent-bg' : '');
            }elseif($project->special) {
                $r .= 'special' . ($bg ? ' special-bg' : '');
            }elseif($project->hire) {
                $r .= 'hire' . ($bg ? ' hire-bg' : '');
            }
            return $r;
        }
    }
}

// Project Publish Status
if (!function_exists('publish_status')) {
    function publish_status($project,$badge=true,$full=true)
    {
        if($full){
            if($project->isExpired()){
                return 'زمان مناقصه پایان یافته';
            }
        }
        if($badge){
            if($project->publish_status == "open"){
                return '<span class="badge badge-info">باز</span>';
            }elseif($project->publish_status == "canceled") {
                return '<span class="badge badge-success">لغو شده</span>';
            }elseif($project->publish_status == "pending") {
                return '<span class="badge badge-danger">در انتظار تایید</span>';
            }elseif($project->publish_status == "draft") {
                return '<span class="badge badge-secondary">پیشنویس</span>';
            }elseif($project->publish_status == "closed") {
                return '<span class="badge badge-success">پایان یافته</span>';
            }
        }else {
            if($project->publish_status == "open"){
                return 'باز';
            }elseif($project->publish_status == "canceled") {
                return 'لغو شده';
            }elseif($project->publish_status == "pending") {
                return 'در انتظار تایید';
            }elseif($project->publish_status == "draft") {
                return 'پیشنویس';
            }elseif($project->publish_status == "closed") {
                return 'پایان یافته';
            }
        }
    }
}

if (!function_exists('project_range')) {
    function project_range($range,$return=false)
    {
        if($return){
            switch ($range){
                case 1 : return [5000,100000];break;
                case 2 : return [100000,300000];break;
                case 3 : return [300000,750000];break;
                case 4 : return [750000,5000000];break;
                case 5 : return [5000000,15000000];break;
                case 6 : return [15000000,50000000];break;
            }
        }else {
            switch ($range){
                case 1 : return "خیلی کوچیک";break;
                case 2 : return "کوچیک";break;
                case 3 : return "متوسط";break;
                case 4 : return "نسبتا بزرگ";break;
                case 5 : return "بزرگ";break;
                case 6 : return "خیلی بزرگ";break;
            }
        }
    }
}

if (!function_exists('checkPage')) {
    function checkPage($key,$return=true){
        if($return){
            if(Str::contains($key,'*')){
                return \Request::is($key) ? 'active starPoint' : null;
            }else {
                return \Route::current()->getName() == $key ? 'active starPoint' : null;
            }
        }else{
            if(Str::contains($key,'*')){
                return \Request::is($key);
            }else {
                return \Route::current()->getName() == $key;
            }
        }
    }
}

if (!function_exists('option')) {
    function option($key=null,$value=null)
    {
        if(!is_null($key) && !is_null($value)){
            $o = \App\Option::where('key',$key)->first();
            if($o){
                $o->update(['value'=>$value]);
            }else {
                \App\Option::create(['key'=>$key,'value'=>$value]);
            }
            return $value;
        }
        if(!is_null($key)){
            if($o = \App\Option::where('key',$key)->first()){
                return is_int($o->value) ? intval($o->value) : $o->value;
            }
            return null;
        }
        return null;
    }
}

if (!function_exists('humanSize')) {
    function humanSize($size,$space=false)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ($space ? '' : ' ') . $units[$power];
    }
}


if (!function_exists('getPercent')) {
    function getPercent($number, $percent,$val=false)
    {
        if($val){
            return ($percent / 100) * $number;
        }else {
            return $number - (($percent / 100) * $number);
        }
    }
}

if (!function_exists('render')) {
    function render($render,$class=null)
    {
        $class = $class ? $class : "justify-content-center h6 small pr-0 mb-0";
        return str_replace('"pagination"',"\"pagination {$class}\"",$render);
    }
}

if (!function_exists('profile')) {
    function profile($percent=false,$color=false)
    {
        if($percent){
            $res = 0;
            if(user()->nickname){
                $res += 40;
            }
            if(user()->info){
                $res += 20;
            }
            if(user()->skills()->count()){
                $res += 20;
            }
            if(user()->email_verified_at){
                $res += 20;
            }
            return $res;
        }elseif($color){
            $avg = profile(true);
            $res = '';
            if($avg >= 40){
                $res = 'info';
            }
            if($avg >= 60){
                $res = 'success';
            }
            if($avg >= 80){
                $res = 'warning';
            }
            if($avg == 100){
                $res = 'danger';
            }
            return $res;
        }else {
            $res = [];
            if(!user()->nickname){
                $res[0]['text'] = 'چرا نام مستعار خود را ثبت نمیکنی ؟';
                $res[0]['link'] = route('resume.edit');
            }
            if(!user()->info){
                $res[1]['text'] = 'چرا شانس خودت رو با نوشتن رزومت افزایش نمیدی ؟';
                $res[1]['link'] = route('resume.edit');
            }
            if(user()->skills->count() < 1){
                $res[2]['text'] = 'چرا مهارت هارو ثبت نمیکنی ؟';
                $res[2]['link'] = route('resume.edit');
            }
            if(!user()->email_verified_at){
                $res[3]['text'] = 'چرا ایمیلت رو تایید نمیکنی ؟';
            }
            if(count($res) < 1){
                $res[0]['text'] = 'آفرین , به نظر میاد پروفایل کاملی داری !';
            }
            return $res;
        }
    }
}

if (!function_exists('contains')) {
    function contains($str,$needle)
    {
        return Str::contains($str,$needle);
    }
}

if (!function_exists('dayToMonth')) {
    function dayToMonth(int $length)
    {
        switch ($length){
            case 31 : return 'ماهانه';
            case 62 : return '2 ماهه';
            case 93 : return '3 ماهه';
            case 365 : return 'سالیانه';
            default : return $length . ' روز ';
        }
    }
}

if (!function_exists('brToN')) {
    function brToN($string)
    {
        return str_replace("<br>","\n",$string);
    }
}

if (!function_exists('nToBr')) {
    function nToBr($string)
    {
        return str_replace("\n","<br>",$string);
    }
}

if (!function_exists('justBr')) {
    function justBr($string)
    {
        return strip_tags($string,'<br>');
    }
}

if (!function_exists('scriptStripper')) {
    function scriptStripper($input)
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $input);
    }
}

if (!function_exists('paymentType')) {
    function paymentType(\App\Payment $payment)
    {
        switch ($payment->type) {
            case 'payment' :
                return 'پرداختی به سایت';
                break;
            case 'deposit' :
                return 'گروگزاری';
                break;
        }
    }
}

if (!function_exists('portfolioStatus')) {
    function portfolioStatus(\App\Portfolio $portfolio)
    {
        if($portfolio->draft){
            return "<span class='badge badge-secondary'>پیشنویس</span>";
        }else {
            if($portfolio->status == 'success'){
                return "<span class='badge badge-success'>تایید شده</span>";
            }elseif($portfolio->status == 'pending') {
                return "<span class='badge badge-warning'>در انتظار تایید</span>";
            }else {
                return "<span class='badge badge-danger'>رد شده</span>";
            }
        }
    }
}

if (!function_exists('sms')){
    function sms($to,$msg,$pattern=[]){
        $driver = option('sms_driver') ?? option('sms_driver','farazsms');
        if($driver == 'farazsms'){
            $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
            $user = option('sms_username');
            $pass = option('sms_password');
            $fromNum = option('sms_from') ?? "+98100020400";
            if(!empty($pattern)){
                $client->sendPatternSms($fromNum,[$to],$user,$pass,$pattern['pattern'],$pattern['input']);
            }else {
                $op  = "send";
                $time = '';
                $client->SendSMS($fromNum,[$to],$msg,$user,$pass,$time,$op);
            }
        }
    }
}

if (!function_exists('messageStatus')) {
    function messageStatus(\App\Conversation $conversation)
    {
        if($conversation->status == 'pending'){
            return "<div class='d-inline-block text-secondary'><i class='fa fa-check'></i></div>";
        }elseif($conversation->status == 'rejected'){
            return "<div class='d-inline-block text-danger'><i class='fa fa-close'></i></div>";
        }else {
            if($conversation->read){
                return "<div class='d-inline-block text-success'><i class='fa fa-check'></i><i class='fa fa-check'></i></div>";
            }else {
                return "<div class='d-inline-block text-success'><i class='fa fa-check'></i></div>";
            }
        }
    }
}


if (!function_exists('ticket_type')) {
    function ticket_type(\App\Ticket $ticket,$badge=true,$icon=false)
    {
        if($badge){
            if($ticket->type == "judgement"){
                return '<span class="badge badge-warning">داوری</span>';
            }elseif($ticket->type == "support") {
                return '<span class="badge badge-primary">پشتیبانی</span>';
            }elseif($ticket->type == "question") {
                return '<span class="badge badge-secondary">سوال</span>';
            }elseif($ticket->type == "suggestions") {
                return '<span class="badge badge-info">پیشنهادات</span>';
            }elseif($ticket->type == "critics") {
                return '<span class="badge badge-danger">انتقادات</span>';
            }
        }elseif($icon){
            if($ticket->type == "judgement"){
                return '<span class="text-warning"><i class="fa fa-balance-scale align-middle"></i></span>';
            }elseif($ticket->type == "support") {
                return '<span class="text-primary"><i class="fa fa-life-ring align-middle"></i></span>';
            }elseif($ticket->type == "question") {
                return '<span class="text-secondary"><i class="fa fa-question-circle align-middle"></i></span>';
            }elseif($ticket->type == "suggestions") {
                return '<span class="text-info"><i class="fa fa-comments align-middle"></i></span>';
            }elseif($ticket->type == "critics") {
                return '<span class="text-danger"><i class="fa fa-commenting align-middle"></i></span>';
            }
        }else {
            if($ticket->type == "judgement"){
                return 'داوری';
            }elseif($ticket->type == "support") {
                return 'پشتیبانی';
            }elseif($ticket->type == "question") {
                return 'سوال';
            }elseif($ticket->type == "suggestions") {
                return 'پیشنهادات';
            }elseif($ticket->type == "critics") {
                return 'انتقادات';
            }
        }
    }
}

if (!function_exists('ticket_status')) {
    function ticket_status(\App\Ticket $ticket,$badge=true)
    {
        if($badge){
            if($ticket->status == "open"){
                return '<span class="badge badge-primary">باز</span>';
            }else {
                return '<span class="badge badge-warning">بسته</span>';
            }
        }else {
            if($ticket->status == "open"){
                return 'باز';
            }else {
                return 'بسته';
            }
        }
    }
}
