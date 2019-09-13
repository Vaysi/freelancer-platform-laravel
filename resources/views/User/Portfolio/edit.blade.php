@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="portfolio">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between">
                        <span>ویرایش نمونه کار</span>
                        <a href="{{ route('portfolio.index') }}" class="btn btn-outline-info round btn-sm">نمونه کار ها</a>
                    </div>
                    <div class="card-body py-3">
                        <div class="alert alert-info rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-exclamation"></i>
                                </div>
                                <div class="col-10">
                                    <span class="bold h6">نکات مهم</span>
                                    <p class="mb-1">فقط فایلهای فرمت JPG,JPEG, PNG وGIF مورد قبول است.</p>
                                    <p class="mb-1">حداکثر حجم مورد قبول 8MB می باشد.</p>
                                    <p class="mb-1">حداقل سایز مورد قبول 750x750 پیکسل می باشد.</p>
                                    <p class="mb-1">حداکثر سایز مورد قبول 4680x4680 پیکسل می باشد.</p>
                                    <p class="text-danger font-weight-bold mb-1">تصاویر نباید حاوی اطلاعات تماس باشند.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-11 mx-auto">
                            <form action="{{ route('portfolio.update',['portfolio'=>$portfolio->id]) }}" method="post" class="corner">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">عنوان</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{ $portfolio->title ?? old('title') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">توضیحات</label>
                                            <input type="text" class="form-control" id="description" name="description" value="{{ $portfolio->description ?? old('description') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">مهارت ها</label>
                                            <select name="skills[]" id="skills" class="selectpicker mb-2" data-live-search="true" multiple title="مهارت لازم را انتخاب کنید" data-max-options="8">
                                                @foreach(\App\Category::latest()->get() as $category)
                                                    @continue($category->skills()->count() < 1)
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach($category->skills()->get() as $skill)
                                                            <option value="{{ $skill->id }}" {{ in_array($skill->id,$portfolio->skills()->pluck('id')->toArray() ?? old('skills') ?? []) ? 'selected' : '' }}>{{ trim($skill->name) }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="file" class="mt-2 mb-1">ضمیمه فایل</label>
                                            <input type="file" name="file[]" id="file" class="filepond" multiple data-max-file-size="3MB">
                                        </div>
                                    </div>
                                    <div class="col-12" id="vuejs">
                                        <div class="form-group">
                                            <div class="row">
                                                @foreach($portfolio->withoutThumb() as $img)
                                                    <div class="col-3 position-relative collapse show" id="img{{ $loop->iteration }}">
                                                        <img src="{{ asset($img) }}" class="img-fluid rounded img-thumbnail">
                                                        <button type="button" @click="removeImage('{{ encrypt($img) }}','#img{{ $loop->iteration }}')" class="btn btn-danger btn-circle-sm position-absolute d-flex justify-content-center align-items-center" style="top:5px;left: 20px;"><i class="fa fa-close"></i></button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-outline-danger" type="submit" name="submit">بروزرسانی نمونه کار</button>
                                        <button class="btn btn-outline-secondary" type="submit" name="draft">ذخیره در پیشنویس</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        $(function () {
            const inputElement = document.querySelector('#file');
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            const pond = FilePond.create( inputElement ,{
                acceptedFileTypes: ["image/*"],
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
            let app = new Vue({
                el:"#vuejs",
                data:{
                    url: "{{ route('portfolio.remove',['portfolio'=>$portfolio->id]) }}"
                },
                methods:{
                    removeImage(id,element){
                        let app = this;
                        axios.post(this.url,{
                            id:id
                        }).then((resp) => {
                            if(resp.data.status){
                                $(element).collapse('hide').remove();
                            }else {
                                swal({
                                    type: 'error',
                                    title: 'خطا !',
                                    text: resp.data.msg,
                                    confirmButtonText: 'خروج',
                                    animation: false,
                                    customClass: 'animated tada'
                                });
                            }
                        });
                    }
                }
            });
        });
    </script>
@stop
