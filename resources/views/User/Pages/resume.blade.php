@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>ویرایش رزومه</span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-yellow rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-exclamation"></i>
                                </div>
                                <div class="col-10">
                                    <span class="bold">هشدار در مورد اطلاعات تماس</span>
                                    <p>درج اطلاعات تماس اعم از آدرس سایت شرکت و شخصی، ایمیل، شماره تماس و پروفایل شبکه های اجتماعی به هر طریقی ممنوع است. <br>
                                        در صورت مشاهده اطلاعات تماس، رزومه شما حذف خواهد شد.</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('resume.update') }}" class="corner" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="nickname" class="form-label">نام مستعار :</label>
                                <input type="text" name="nickname" value="{{ user()->nickname ?? old('nickname') }}" class="form-control" id="nickname">
                                <small id="nameHelp" class="form-text text-muted">تجربه ما نشان داده که تاثیر اسامی واقعی سه برابر بیشتر از اسامی فرضی است.</small>
                            </div>
                            <div class="form-group">
                                <label for="info" class="form-label">متن رزومه</label>
                                <textarea type="text" name="info" class="form-control editordata" id="info">{{ user()->info ?? old('info') }}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="skills" class="form-label">مهارت های شما</label>
                                <select name="skills[]" id="skills" class="selectpicker" data-max-options="8" data-live-search="true" multiple data-max-options="8" title="مهارت خود را از لیست زیر انتخاب کنید">
                                    @foreach(\App\Category::latest()->get() as $category)
                                        @continue($category->skills()->count() < 1)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach($category->skills()->get() as $skill)
                                                <option value="{{ $skill->id }}" {{ user()->skills()->count() ? in_array($skill->id,user()->skills()->pluck('id')->toArray()) ? 'selected' : '' : in_array($skill->id,old('skills') ?? []) ? 'selected' : '' }}>{{ trim($skill->name) }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <small id="skillsHelp" class="form-text text-muted">حداکثر 8 مورد</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-info w-100">ذخیره کردن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span>نکات قابل توجه</span>
            </div>
            <div class="card-body small" >
                <p>یک نگاه دقیق به پروفایل خود در پارسکدرز بیاندارید. آیا به‌اندازه کافی متمرکز است؟</p>
                <p>آیا نمونه کارهای مرتبط با تخصصتان در رزومه‌تان دارید؟ آیا مشتری‌ها با یک نگاه به پروفایل و نمونه کار شما متوجه خواهند شد که با چه ابزارهایی کار می‌کنید و بهترین کار شما در چه زمینه‌ای است؟</p>
                <p>اگر این طور نیست تلاش کنید که پروفایلتان را تا حد امکان بهبود دهید.</p>
                <ul class="text-secondary pr-2">
                    <li>نام کاربری بیانگر برند و هویت شماست.</li>
                    <li>توضیحات را کامل و با سلیقه بنویسید.</li>
                    <li>اطلاعات پس از تایید مدیر به نمایش درخواهد آمد.</li>
                </ul>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $.extend($.summernote.lang, {
            'fa-IR': {
                font: {
                    bold: 'درشت',
                    italic: 'خمیده',
                    underline: 'میان خط',
                    clear: 'پاک کردن فرمت فونت',
                    height: 'فاصله ی خطی',
                    name: 'اسم فونت',
                    strikethrough: 'Strike',
                    subscript: 'Subscript',
                    superscript: 'Superscript',
                    size: 'اندازه ی فونت',
                },
                image: {
                    image: 'تصویر',
                    insert: 'وارد کردن تصویر',
                    resizeFull: 'تغییر به اندازه ی کامل',
                    resizeHalf: 'تغییر به اندازه نصف',
                    resizeQuarter: 'تغییر به اندازه یک چهارم',
                    floatLeft: 'چسباندن به چپ',
                    floatRight: 'چسباندن به راست',
                    floatNone: 'بدون چسبندگی',
                    shapeRounded: 'Shape: Rounded',
                    shapeCircle: 'Shape: Circle',
                    shapeThumbnail: 'Shape: Thumbnail',
                    shapeNone: 'Shape: None',
                    dragImageHere: 'یک تصویر را اینجا بکشید',
                    dropImage: 'Drop image or Text',
                    selectFromFiles: 'فایل ها را انتخاب کنید',
                    maximumFileSize: 'Maximum file size',
                    maximumFileSizeError: 'Maximum file size exceeded.',
                    url: 'آدرس تصویر',
                    remove: 'حذف تصویر',
                    original: 'Original',
                },
                video: {
                    video: 'ویدیو',
                    videoLink: 'لینک ویدیو',
                    insert: 'افزودن ویدیو',
                    url: 'آدرس ویدیو ؟',
                    providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion یا Youku)',
                },
                link: {
                    link: 'لینک',
                    insert: 'اضافه کردن لینک',
                    unlink: 'حذف لینک',
                    edit: 'ویرایش',
                    textToDisplay: 'متن جهت نمایش',
                    url: 'این لینک به چه آدرسی باید برود ؟',
                    openInNewWindow: 'در یک پنجره ی جدید باز شود',
                },
                table: {
                    table: 'جدول',
                    addRowAbove: 'Add row above',
                    addRowBelow: 'Add row below',
                    addColLeft: 'Add column left',
                    addColRight: 'Add column right',
                    delRow: 'Delete row',
                    delCol: 'Delete column',
                    delTable: 'Delete table',
                },
                hr: {
                    insert: 'افزودن خط افقی',
                },
                style: {
                    style: 'استیل',
                    p: 'نرمال',
                    blockquote: 'نقل قول',
                    pre: 'کد',
                    h1: 'سرتیتر 1',
                    h2: 'سرتیتر 2',
                    h3: 'سرتیتر 3',
                    h4: 'سرتیتر 4',
                    h5: 'سرتیتر 5',
                    h6: 'سرتیتر 6',
                },
                lists: {
                    unordered: 'لیست غیر ترتیبی',
                    ordered: 'لیست ترتیبی',
                },
                options: {
                    help: 'راهنما',
                    fullscreen: 'نمایش تمام صفحه',
                    codeview: 'مشاهده ی کد',
                },
                paragraph: {
                    paragraph: 'پاراگراف',
                    outdent: 'کاهش تو رفتگی',
                    indent: 'افزایش تو رفتگی',
                    left: 'چپ چین',
                    center: 'میان چین',
                    right: 'راست چین',
                    justify: 'بلوک چین',
                },
                color: {
                    recent: 'رنگ اخیرا استفاده شده',
                    more: 'رنگ بیشتر',
                    background: 'رنگ پس زمینه',
                    foreground: 'رنگ متن',
                    transparent: 'بی رنگ',
                    setTransparent: 'تنظیم حالت بی رنگ',
                    reset: 'بازنشاندن',
                    resetToDefault: 'حالت پیش فرض',
                },
                shortcut: {
                    shortcuts: 'دکمه های میان بر',
                    close: 'بستن',
                    textFormatting: 'فرمت متن',
                    action: 'عملیات',
                    paragraphFormatting: 'فرمت پاراگراف',
                    documentStyle: 'استیل سند',
                    extraKeys: 'Extra keys',
                },
                help: {
                    'insertParagraph': 'Insert Paragraph',
                    'undo': 'Undoes the last command',
                    'redo': 'Redoes the last command',
                    'tab': 'Tab',
                    'untab': 'Untab',
                    'bold': 'Set a bold style',
                    'italic': 'Set a italic style',
                    'underline': 'Set a underline style',
                    'strikethrough': 'Set a strikethrough style',
                    'removeFormat': 'Clean a style',
                    'justifyLeft': 'Set left align',
                    'justifyCenter': 'Set center align',
                    'justifyRight': 'Set right align',
                    'justifyFull': 'Set full align',
                    'insertUnorderedList': 'Toggle unordered list',
                    'insertOrderedList': 'Toggle ordered list',
                    'outdent': 'Outdent on current paragraph',
                    'indent': 'Indent on current paragraph',
                    'formatPara': 'Change current block\'s format as a paragraph(P tag)',
                    'formatH1': 'Change current block\'s format as H1',
                    'formatH2': 'Change current block\'s format as H2',
                    'formatH3': 'Change current block\'s format as H3',
                    'formatH4': 'Change current block\'s format as H4',
                    'formatH5': 'Change current block\'s format as H5',
                    'formatH6': 'Change current block\'s format as H6',
                    'insertHorizontalRule': 'Insert horizontal rule',
                    'linkDialog.show': 'Show Link Dialog',
                },
                history: {
                    undo: 'واچیدن',
                    redo: 'بازچیدن',
                },
                specialChar: {
                    specialChar: 'SPECIAL CHARACTERS',
                    select: 'Select Special characters',
                },
            },
        });
        $(function(){
            $('.editordata').summernote({
                lang : 'fa-IR',
                placeholder: 'متن رزومه خود را بنویسید ...',
                height:150
            }).summernote('justifyRight');
        });
    </script>
@stop
