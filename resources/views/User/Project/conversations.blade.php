@extends('User.master')
@section('page',$project->title)
@section('content')
    <div class="col-8 pl-1">
        @include('User.Project.details')
        @if($project->conversations()->us($project,$page == 'fte' ? null : $user)->count())
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card custom">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <span>گفتگو ها</span>
                        </div>
                        <div class="card-body pt-3" id="messages">
                            @foreach($project->conversations()->us($project,$page == 'fte' ? null : $user)->oldest()->get() as $conversation)
                                @continue($conversation->status != 'confirmed' && $conversation->user_id != user()->id)
                                @if($conversation->done)
                                    <div class="alert alert-success rounded-corner-5">
                                        <div class="row row-eq-height">
                                            <div class="col-12 m-0 h5 text-center">
                                                <span class="bold">مجری کار را تحویل داده</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="item {{ $conversation->isFromMe() }} mb-5" id="msg{{ $conversation->id }}">
                                    <div class="avatar">
                                        <img src="{{ $conversation->user->avatar }}" class="rounded-circle img-thumbnail img-fluid">
                                    </div>
                                    <div class="content {{ $conversation->isFromMe() }}">
                                        <div class="wrapper px-4 py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>
                                                    <a href="{{ $conversation->user->resumeLink() }}">{{ $conversation->user->name() }}</a>
                                                    <span class="small text-secondary" data-toggle="tooltip" data-placement="top" title="{{ jdate($conversation->created_at)->format('Y/m/d H:i:s') }}">{{ jdate($conversation->created_at)->ago() }}</span>
                                                </span>
                                                {!! messageStatus($conversation) !!}
                                            </div>
                                            <div class="pt-4 pb-2">
                                                {!! justBr($conversation->message)  !!}
                                                @if($conversation->files()->count())
                                                    <div class="mb-2 mt-4">
                                                        <span class="bg-secondary-3 rounded-half px-2"><i class="fa fa-link"></i> ضمیمه </span>
                                                        @foreach($conversation->files()->get() as $file)
                                                            <div class="my-1 text-left">
                                                                <a href="{{ $file->link() }}" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="{{ humanSize($file->size,true) }}"><span class="ltr">{{ $file->id }}.{{ $file->type }}</span> <i class="fa fa-download"></i></a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if($project->starts_at)
                                <div class="alert alert-info rounded-corner-5">
                                    <div class="row row-eq-height">
                                        <div class="col-2 icon display-4 text-center">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="col-10">
                                            <span class="bold h5">مهلت انجام پروژه</span>
                                            <p class="h6 mt-2">از {{ jdate($project->starts_at)->format('d F H:i:s') }} تا {{ jdate($project->starts_at)->addDays($project->finalOffer()->deadline)->format('d F H:i:s') }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($project->isFreelancer())
                                <div class="alert alert-success rounded-corner-5 deliverProject collapse">
                                    <div class="row row-eq-height">
                                        <div class="col-2 icon display-4 text-center">
                                            <i class="fa fa-gift"></i>
                                        </div>
                                        <div class="col-10">
                                            <span class="bold h5">تحویل کار به کارفرما</span>
                                            <p class="h6 mt-2">توضیحی برای کارفرما بنویسید و در صورت وجود فایل های پروژه را ضمیمه کنید .</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ $project->isEmployer() ? route('conversations.etf.store',['project'=>$project->id,'user'=>$user->id]) : route('conversations.fte.store',['project' => $project->id]) }}" class="corner mt-2" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="message" class="form-label">پیام</label>
                                    <textarea type="text" name="message" class="form-control" id="message" rows="5">{{ old('message') }}</textarea>
                                    @if($project->isFreelancer())
                                        <div class="deliverProject collapse">
                                            <label class="my-2"><input type="checkbox" name="deliver" id="deliver" value="1" class="checkbox color-success is-material has-animation is-large" /> تحویل پروژه به کارفرما </label>
                                        </div>
                                    @endif
                                    <label for="attachment" class="mt-2 mb-1">ضمیمه فایل</label>
                                    <input type="file" name="file[]" id="attachment" class="filepond" multiple data-max-file-size="3MB">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-info w-100">ارسال پیام</button>
                                </div>
                            </form>
                            @if(!$project->hire)
                                <div class="alert alert-yellow rounded-corner-5">
                                    <div class="row row-eq-height">
                                        <div class="col-2 icon display-4 text-center">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="col-10">
                                            <span class="bold h6">ارسال اطلاعات تماس به هر نحوی ممنوع است.</span>
                                            <p>شما مجاز به ارسال اطلاعات تماس نیستید. ما از نظر شرعی نیز راضی به این کار نیستیم. در صورت تخطی با کاربر برخورد خواهد شد.</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success rounded-corner-5">
                                    <div class="row row-eq-height">
                                        <div class="col-2 icon display-4 text-center">
                                            <i class="fa fa-exclamation"></i>
                                        </div>
                                        <div class="col-10">
                                            <span class="bold h5">ارسال اطلاعات تماس در این پروژه آزاد است.</span>
                                            <p class="h6">با توجه به نوع پروژه ارسال اطلاعات تماس آزاد است و منعی ندارد.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('User.Project.sidebar')
@stop
@section('js')
    <script src="{{ asset('vendor/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('vendor/filepond/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('vendor/filepond/filepond-plugin-image-preview.min.js') }}"></script>
    <script>
        let warranty = parseInt("{{ $project->min_guarantee }}") , deadLine = parseInt("{{ $project->deadline }}");
        $(function () {
            const inputElement = document.querySelector('#attachment');
            const inputElement2 = document.querySelector('#attachment2');
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const pond = FilePond.create( inputElement ,{
                acceptedFileTypes: ["application/x-7z-compressed","audio/*","application/postscript","video/*","application/octet-stream","application/mac-binary","application/sql","application/macbinary","application/x-binary","application/x-macbinary","image/*","application/x-bzip2","text/plain","application/msword","application/vnd.ms-fontobject","application/x-compressed","application/x-gzip","text/html","text/x-pascal","application/pdf","application/mspowerpoint","application/powerpoint","application/vnd.ms-powerpoint","application/x-mspowerpoint","application/vnd.openxmlformats-officedocument.presentationml.presentation","application/x-rar-compressed","application/rtf","application/x-rtf","text/richtext","application/x-shockwave-flash","application/x-tar","audio/wav","application/excel","application/vnd.ms-excel","application/x-excel","application/x-msexcel","application/xml","text/xml","application/x-compressed","application/x-zip-compressed","application/zip","multipart/x-zip","application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
            });
            const pond2 = FilePond.create( inputElement2 ,{
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
            $("#price").on('keyup change',function () {
                let price = parseInt($(this).val());
                if(price > 1000000){
                    $("#prepayment").parents('.form-group').collapse('show');
                }else {
                    $("#prepayment").parents('.form-group').collapse('hide');
                }
            });
            $("#warranty").on('change',function () {
                let vall = parseInt($(this).val());
                if(vall < warranty){
                    $("#warranty").val(warranty);
                }
            });
            $("#deadline").on('change',function () {
                let vall = parseInt($(this).val());
                if(vall > deadLine){
                    $("#deadline").val(deadLine);
                }
            });
            $(".deliverIt").click(function () {
                $(".deliverProject").collapse('show');
                moveScroll('.deliverProject');
                $("#deliver").attr('selected','selected');
            });
            let isEmpty = $("#buttons .card-body").text().trim().length;
            if(isEmpty < 2){
                $("#buttons").hide();
            }
        });
    </script>
@endsection
