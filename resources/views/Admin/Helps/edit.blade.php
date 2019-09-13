@extends('Admin.master')
@section('title','راهنما ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ویرایش راهنما</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('helps.update',['help'=>$help->id]) }}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="title">عنوان راهنما</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $help->title ?? old('title') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="location">مکان نمایش</label>
                        <select class="form-control select2 w-100" id="location" name="location">
                            <option value="intro" {{ $help->location == 'intro' ? 'selected' : '' }}>معرفی</option>
                            <option value="freelancer" {{ $help->location == 'freelancer' ? 'selected' : '' }}>مجری یا فریلنسر</option>
                            <option value="employer" {{ $help->location == 'employer' ? 'selected' : '' }}>خریدار یا کارفرما</option>
                            <option value="financial" {{ $help->location == 'financial' ? 'selected' : '' }}>امور مالی</option>
                            <option value="law" {{ $help->location == 'law' ? 'selected' : '' }}>مسائل حقوقی</option>
                            <option value="other" {{ $help->location == 'other' ? 'selected' : '' }}>سایر موارد</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="content">توضیحات</label>
                        <textarea type="text" name="content" class="form-control editordata" id="content">{!! $help->content ?? old('content') !!}</textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">ویرایش</button>
                <a href="{{ route('helps.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/fa.js') }}"></script>
    <script src="{{ asset('vendor/summernote-bs4.min.js') }}"></script>
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
        $(function () {
            $('.select2').select2();
            $('.editordata').summernote({
                lang : 'fa-IR',
                placeholder: ' توضیحات خود را بنویسید !',
                height:150
            }).summernote('justifyRight');
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@stop
