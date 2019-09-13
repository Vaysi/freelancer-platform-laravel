@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="newProject">
                <div class="card custom">
                    <div class="card-title">
                        <span>ویرایش پروژه  <span class="font-weight-bold">{{ $project->title }}</span></span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-yellow rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-exclamation"></i>
                                </div>
                                <div class="col-10">
                                    <span class="bold">لطفا قبل از ارسال درخواست خود این بخش را مطالعه نمایید</span>
                                    <ul>
                                        <li>میزان و دقت توضیحات شما نشان دهنده اهمیت آن برای شما می باشد، بنابرین توضیحات را کامل وارد نمایید.</li>
                                        <li>درج هر گونه اطلاعات تماس ممنوع است. مگر اینکه درخواست شما از نوع آگهی استخدام باشد.</li>
                                        <li>جهت ثبت پروژه می بایست مبلغ 5,000 تومان پرداخت شود. (هزینه ثبت پروژه غیرقابل بازگشت است)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('user.project.update',['project'=>$project->id]) }}" method="post" class="corner" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="timeline pb-5">
                                <div class="form-group timeline-item">
                                    <div class="counter">1</div>
                                    <label for="category">پروژه شما در چه موضوعی است ؟</label>
                                    <select name="category_id" id="category" class="selectpicker mb-2 d-block w-auto" title="موضوع پروژه خود را انتخاب کنید">
                                        @foreach(\App\Category::whereParentId(0)->get() as $category)
                                            @php
                                                $parentId = $project->category ? $project->category->parent()->id : null;
                                            @endphp
                                        <option value="{{ $category->id }}" {{ $parentId == $category->id ? 'selected' : '' }} data-icon="w-20p text-center fa {{ $category->icon ? $category->icon : '' }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="subCat">
                                        <select name="subcategory" id="subcategory" class="selectpicker mb-2 d-block w-auto " title="زیر موضوع مربوطه را انتخاب کنید">
                                            @if(optional($project->category)->subcategories())
                                                @foreach(\App\Category::find(intval(optional(optional($project->category)->parent())->id ?? optional($project->category)->id))->subcategories()->get() as $category)
                                                    <option value="{{ $category->id }}" {{ $project->category->id == $category->id ? 'selected' : '' }} data-icon="w-20p text-center fa {{ $category->icon ? $category->icon : '' }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">2</div>
                                    <label for="title">عنوان پروژه : </label>
                                    <input type="text" class="form-control" value="{{ $project->title ?? old('title') }}" maxlength="150" placeholder="عنوان پروژه را وارد کنید" name="title" id="title">
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">3</div>
                                    <label for="skills">مهارت لازم :</label>
                                    <small class="text-mute form-text pt-0 pb-2 text-secondary">می توانید با کلیک بر روی کادر زیر فهرست مهارت ها را مشاهده و انتخاب کنید</small>
                                    <select name="skills[]" id="skills" class="selectpicker mb-2" data-live-search="true" multiple title="مهارت لازم را انتخاب کنید" data-max-options="8">
                                        @foreach(\App\Category::latest()->get() as $category)
                                            @continue($category->skills()->count() < 1)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->skills()->get() as $skill)
                                                    <option value="{{ $skill->id }}" {{ in_array($skill->id,$project->skills()->pluck('id')->toArray()) ?? in_array($skill->id,old('skills') ?? []) ? 'selected' : '' }}>{{ trim($skill->name) }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">4</div>
                                    <label for="content">شرح درخواست : </label>
                                    <textarea class="form-control" placeholder="پروژه درخواستی خود را شرح دهید" name="content" id="content" rows="6">{{ brToN($project->content) ?? old('content') }}</textarea>
                                    <label for="attachment" class="mt-2 mb-1">ضمیمه فایل</label>
                                    <input type="file" name="file[]" id="attachment" class="filepond" multiple data-max-file-size="3MB">
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">5</div>
                                    <label for="price_range">مقدار بودجه مورد نظر شما برای پروژه :</label>
                                    <select name="price_range" id="price_range" class="selectpicker mb-2 d-block w-auto" title="مقدار بودجه را مشخص نمایید">
                                        <option value="1" {{ $project->price_range ?? old('price_range') == 1 ? 'selected' : '' }}> خیلی کوچک ( از 5,000 تومان تا 100,000 تومان ) </option>
                                        <option value="2" {{ $project->price_range ?? old('price_range') == 2 ? 'selected' : '' }}> کوچک ( از 100,000 تومان تا 300,000 تومان ) </option>
                                        <option value="3" {{ $project->price_range ?? old('price_range') == 3 ? 'selected' : '' }}> متوسط ( از 300,000 تومان تا 750,000 تومان ) </option>
                                        <option value="4" {{ $project->price_range ?? old('price_range') == 4 ? 'selected' : '' }}> نسبتا بزرگ ( از 750,000 تومان تا 5,000,000 تومان ) </option>
                                        <option value="5" {{ $project->price_range ?? old('price_range') == 5 ? 'selected' : '' }}> بزرگ ( از 5,000,000 تومان تا 15,000,000 تومان ) </option>
                                        <option value="6" {{ $project->price_range ?? old('price_range') == 6 ? 'selected' : '' }}> خیلی بزرگ ( از 15,000,000 تومان تا 50,000,000 تومان ) </option>
                                    </select>
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">6</div>
                                    <label for="min_guarantee">حداقل ضمانت تخصص :</label>
                                    <select name="min_guarantee" id="min_guarantee" class="selectpicker mb-2 d-block w-auto" title="حداقل ضمانت تخصص">
                                        <option value="0" {{ $project->min_guarantee ?? old('min_guarantee') == "0" ? 'selected' : '' }} label="الزامی نیست" class="text-success">الزامی نیست</option>
                                        <option value="5" {{ $project->min_guarantee ?? old('min_guarantee') == 5 ? 'selected' : '' }} label="5%">5% از کل مبلغ پروژه</option>
                                        <option value="10" {{ $project->min_guarantee ?? old('min_guarantee') == 10 ? 'selected' : '' }} label="10%">10% از کل مبلغ پروژه</option>
                                        <option value="15" {{ $project->min_guarantee ?? old('min_guarantee') == 15 ? 'selected' : '' }} label="15%">15% از کل مبلغ پروژه</option>
                                        <option value="20" {{ $project->min_guarantee ?? old('min_guarantee') == 20 ? 'selected' : '' }} label="20%">20% از کل مبلغ پروژه</option>
                                        <option value="25" {{ $project->min_guarantee ?? old('min_guarantee') == 25 ? 'selected' : '' }} label="25%">25% از کل مبلغ پروژه</option>
                                    </select>
                                </div>
                                <div class="alert alert-yellow rounded-corner-5">
                                    <div class="row row-eq-height">
                                        <div class="col-2 icon display-4 text-center">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="col-10">
                                            <span class="bold">ضمانت تخصص چیست ؟</span>
                                            <p> ضمانت تخصص درصدی از مبلغ پیشنهاد مجری است که مجری برای تضمین صحت انجام کار خود در سایت گروگذاری می کند. برای استفاده از این امکان پروژه باید حداقل از نوع تجاری کوچک (1،000،000 ریال و بیشتر) باشد.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">7</div>
                                    <label for="deadline">مهلت انجام (روز) :</label>
                                    <div class="input-group mb-1">
                                        <input id="deadline" value="{{ $project->deadline ?? old('deadline') }}" name="deadline" type="number" class="form-control" placeholder="مهلت تحویل پروژه" aria-label="محلت تحویل پروژه" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-info text-white" id="basic-addon2">روز</span>
                                        </div>
                                    </div>
                                    <small class="text-mute form-text text-secondary">فقط عدد بنویسید , از نوشتن روز و ماه خود داری کنید</small>
                                </div>
                                <div class="form-group timeline-item">
                                    <div class="counter">8</div>
                                    <label for="price">نوع پروژه :</label>
                                    <small class="text-mute form-text">در صورتی که نیاز به ثبت پروژه ای به غیر از معمولی دارید انتخاب کنید. هزینه ثبت پروژه معمولی <span class="price text-primary">5,000 تومان</span> است. </small>
                                </div>
                                <div class="form-row row-eq-height">
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span>خصوصی</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="private" value="1" class="pOption toggle color-secondary has-animation is-large" {{ $project->private ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3"> در حالت خصوصی عنوان و شرح پروژه از دید کاربران و موتورهای جستجو مخفی می شود و فقط مجریانی که شما آن ها را دعوت کرده اید قادرند جزئیات درخواست را مشاهده کنند.(خصوصی فقط برای مواقعی که مجری را از قبل می شناسید و می خواهید وی را به پروژه دعوت کنید مناسب است) </p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold">{{ money(option('private') ?? 5000) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span class="bg-primary text-white">مخفی</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="hidden" value="1" class="pOption toggle color-primary has-animation is-large" {{ $project->hidden ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3"> در حالت مخفی پروژه شما صرفا از دید موتورهای جستجو و بازدیدکنندگانی که عضو سایت نیستند مخفی می شود. اما کلیه کاربران سایت که وارد سایت شده باشند می توانند جزئیات را ببینند. </p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold ">{{ money(option('hidden') ?? 6500) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span class="bg-warning">پروژه ویژه</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="special" value="1" class="pOption toggle color-warning has-animation is-large" {{ $project->special ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3">با انتخاب این گزینه درخواست شما به صورت ویژه تر و شاخص تر در فهرست درخواست ها دیده می شود و نظر مجریان بیش از پیش معطوف درخواست شما خواهد شد.
                                                    <span class="text-warning">(150درصد موفقیت بیشتر به دلیل جذابیت برای مجری‌های حرفه‌ای.)</span></p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold ">{{ money(option('special') ?? 22000) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span class="bg-danger text-white">فوری</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="urgent" value="1" class="pOption toggle color-danger has-animation is-large" {{ $project->urgent ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3"> با برچسب فوری مجری ها مطلع می شوند که زمان شما کم است، پس سریع تر پیشنهاد ثبت می کنند همچنین <span class="text-danger">حداکثر ۳ روز</span> در فهرست درخواست های باز باقی می ماند. ضمنا یک برچسب فوری بر روی این درخواست درج می‌شود </span></p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold ">{{ money(option('urgent') ?? 65000) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span class="bg-info text-white">استخدام و اعلان</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="hire" value="1" class="pOption toggle color-info has-animation is-large" {{ $project->hire ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3"> در این نوع پروژه شما و مجری مجاز به ارسال اطلاعات تماس هستید </p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold ">{{ money(option('hire') ?? 50000) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <div class="card custom h-100">
                                            <div class="card-title mx-auto">
                                                <span class="bg-primary text-white">چسبنده</span>
                                            </div>
                                            <div class="card-body text-center">
                                                <label class="my-2"><input type="checkbox" name="sticky" value="1" class="pOption toggle color-primary has-animation is-large" {{ $project->sticky ? 'checked' : '' }}></label>
                                                <p class="small text-justify pb-3"> اگر می خواهید پروژه شما دو روز کامل جزء اولین پروژه سایت باشد این گزینه را انتخاب کنید </p>
                                                <div class="text-center absolute-badge">
                                                    <span class="small bg-dark rounded-half text-white p-1 font-weight-bold ">{{ money(option('sticky') ?? 65000) }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-yellow alert-small rounded-corner-5">
                                    <div class="row row-eq-height">
                                        <div class="col-1 icon h2 text-center">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="col-11 pr-4">
                                            <div class="d-flex align-items-center h-100">
                                                <p class="mb-0 pb-0">  هزینه ثبت ارسال این پروژه <span class="bold mx-1" id="tPrice">5,000</span><span class="bold">تومان</span> است که با زدن کلید ارسال درخواست از حساب شما کسر خواهد شد. در صورت عدم وجود موجودی به صفحه پرداخت هدایت خواهید شد. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group timeline-item pt-3">
                                    <div class="counter">9</div>
                                    <button class="btn btn-info" type="submit"><i class="fa fa-check-square"></i> ویرایش درخواست </button>
                                    <button type="submit" class="btn btn-secondary" name="draft"><i class="fa fa-file"></i> ذخیره در پیشنویس </button>
                                    <p class="mt-3 small">با ارسال درخواست قوانین <a href="" class="text-info">پروژستان</a> پذیرفته شده تلقی میگردد .</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('vendor/filepond/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('vendor/filepond/filepond-plugin-image-preview.min.js') }}"></script>
    <script>
        let subcategory_page = "{{ route('user.project.store.categories') }}";
        let defaultPrice = "{{ option('normal') ?? '5000' }}", privatePlan = "{{ option('private') ?? '5000' }}",hidden = "{{ option('hidden') ?? '6500' }}",special="{{ option('special') ?? '22000' }}",urgent="{{ option('urgent') ?? '65000' }}",hire="{{ option('hire') ?? '50000' }}",sticky="{{ option('sticky') ?? '65000' }}",totalPrice=parseInt(defaultPrice);
        $(function () {
            $('#category').change(function () {
                let id = $(this).val();
                $.ajax({
                    type:'POST',
                    url:subcategory_page,
                    data:{_token:csrf, id:id},
                    dataType:'json',
                    success:function(data){
                        if(data.status){
                            if(data.data){
                                $("#subcategory").empty();
                                for (let item in data.data) {
                                    $('#subcategory').append(`<option value="${data.data[item].id}" data-icon="wp-20p text-center fa ${data.data[item].icon}">${data.data[item].name}</option>`);
                                }
                                $("#subcategory").selectpicker('refresh');
                            }
                        }else {
                            Swal.fire({"title":"خطا!","text":data.msg,"showConfirmButton":true,"type":"error"});
                        }
                    }
                });
            });
            const inputElement = document.querySelector('#attachment');
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const pond = FilePond.create( inputElement ,{
                acceptedFileTypes: ["application/x-7z-compressed","audio/*","application/postscript","video/*","application/octet-stream","application/mac-binary","application/sql","application/macbinary","application/x-binary","application/x-macbinary","image/*","application/x-bzip2","text/plain","application/msword","application/vnd.ms-fontobject","application/x-compressed","application/x-gzip","text/html","text/x-pascal","application/pdf","application/mspowerpoint","application/powerpoint","application/vnd.ms-powerpoint","application/x-mspowerpoint","application/vnd.openxmlformats-officedocument.presentationml.presentation","application/x-rar-compressed","application/rtf","application/x-rtf","text/richtext","application/x-shockwave-flash","application/x-tar","audio/wav","application/excel","application/vnd.ms-excel","application/x-excel","application/x-msexcel","application/xml","text/xml","application/x-compressed","application/x-zip-compressed","application/zip","multipart/x-zip","application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
            });
            FilePond.setOptions({
                server: {
                    process: {
                        url:"{{ url('filepond/api/process') }}",
                        ondata: (formData) => {
                            formData.append('_token', csrf);
                            return formData;
                        }
                    },
                    fetch: null,
                    revert: null
                },
                labelIdle:'فایل هایتان را اینجا بکشید یا<span class="filepond--label-action"> انتخاب کنید </span>',
                labelInvalidField:'فایل نا معتبر',
                labelFileWaitingForSize:'در حال دریافت اندازه',
                labelFileSizeNotAvailable:'اندازه معتبر نیست',
                labelFileLoading:'در حال بارگیری ...',
                labelFileLoadError:'خطا در بارگیری',
                labelFileProcessing:'در حال آپلود',
                labelFileProcessingComplete:'آپلود انجام شد',
                labelFileProcessingAborted:'آپلود لغو شد',
                labelFileProcessingError:'خطا در آپلود',
                labelFileProcessingRevertError:'خطا در حذف فایل',
                labelFileRemoveError:'خطا در حذف فایل',
                labelTapToCancel:'حذف فایل',
                labelTapToRetry:'تلاش مجدد',
                labelTapToUndo:'بازگشت',
                labelButtonRemoveItem:'حذف',
                labelButtonAbortItemLoad:'لغو',
                labelButtonRetryItemLoad:'تلاش مجدد',
                labelButtonAbortItemProcessing:'لغو',
                labelButtonUndoItemProcessing:'بازگشت',
                labelButtonRetryItemProcessing:'تلاش مجدد',
                labelButtonProcessItem:'آپلود'
            });
            $(".pOption").change(function () {
                let price = 0;
                switch ($(this).attr('name')) {
                    case 'private' : price = privatePlan;break;
                    case 'hidden' : price = hidden;break;
                    case 'special' : price = special;break;
                    case 'urgent' : price = urgent;break;
                    case 'hire' : price = hire;break;
                    case 'sticky' : price = sticky;break;
                }
                if($(this).is(':checked')){
                    totalPrice += parseInt(price);
                }else {
                    if(totalPrice > 5001){
                        totalPrice -= parseInt(price);
                    }
                }
                $("#tPrice").text(number_format(parseInt(totalPrice)));
            });
        });
    </script>
@stop
