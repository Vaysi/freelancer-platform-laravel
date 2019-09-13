@extends('Admin.master')
@section('title','پکیج ها')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">پکیج جدید</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('packages.update',['package'=>$package->id]) }}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="name">نام پکیج</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $package->name }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="price">قیمت (تومان)</label>
                        <input type="number" min="0" step="1000" class="form-control" value="{{ old('price') ?? $package->price }}" id="price" name="price">
                        <span class="text-mute form-text text-secondary small">وارد نکردن قیمت یا عدد 0 به عنوان رایگان ارائه میشود</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="length">مدت زمان (روز)</label>
                        <input type="number" min="1" step="1" class="form-control" value="{{ old('length') ?? $package->length }}" id="length" name="length">
                    </div>
                    <div class="form-group col-6">
                        <label for="icon">آیکون</label>
                        <select class="form-control select2 w-100" id="icon" name="icon">
                            <option value="free.png" {{ old('icon') == 'free.png' || contains($package->icon,'free.png') ? 'selected' : '' }}>آبی</option>
                            <option value="silver.png" {{ old('icon') == 'silver.png' || contains($package->icon,'silver.png') ? 'selected' : '' }}>نقره ای</option>
                            <option value="bronze.png" {{ old('icon') == 'bronze.png' || contains($package->icon,'bronze.png') ? 'selected' : '' }}>برنزی</option>
                            <option value="gold.png" {{ old('icon') == 'gold.png' || contains($package->icon,'gold.png') ? 'selected' : '' }}>طلایی</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="fee">کمیسیون سایت (درصد)</label>
                        <input type="number" min="1" class="form-control" id="fee" required name="features[fee]" value="{{ old('features.fee') ?? $package->features->fee }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="max">انجام پروژه همزمان (حداکثر)</label>
                        <input type="number" min="-1" class="form-control" id="max" required name="features[max]" value="{{ old('features.max') ?? $package->features->max }}">
                        <span class="text-mute form-text text-secondary small">عدد -1 به معنای نامحدود میباشد !</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="portfolio">تعداد نمونه کار ها ( حداکثر)</label>
                        <input type="number" min="-1" class="form-control" id="portfolio" required name="features[portfolio]" value="{{ old('features.portfolio') ?? $package->features->portfolio }}">
                        <span class="text-mute form-text text-secondary small">عدد -1 به معنای نامحدود میباشد !</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="desc1">توضیح دلخواه شماره اول</label>
                        <input type="text" class="form-control" id="desc1" name="features[desc1]" value="{{ old('features.desc1') ?? $package->features->desc1 }}">
                        <span class="text-mute form-text text-secondary small">این توضیحات به عنوان آیتم در صفحه پکیج ها نمایش داده میشود</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="desc2">توضیح دلخواه شماره دوم</label>
                        <input type="text" class="form-control" id="desc2" name="features[desc2]" value="{{ old('features.desc2') ?? $package->features->desc2 }}">
                        <span class="text-mute form-text text-secondary small">این توضیحات به عنوان آیتم در صفحه پکیج ها نمایش داده میشود</span>
                    </div>
                    <div class="form-group col-6">
                        <label for="popular">پکیج محبوب شود ؟</label>
                        <div>
                            <input type="checkbox" name="popular" id="popular" {{ old('popular') || boolval($package->popular) ? 'checked' : '' }}>
                            <label for="popular">
                                محبوب
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="min">حداقل پروژه های انجام شده</label>
                        <input type="number" min="0" step="1" class="form-control" value="{{ old('min') ?? $package->min }}" id="min" name="min">
                        <span class="text-mute form-text text-secondary small">حداقل پروژه هایی که کاربر باید انجام داده باشد تا بتواند این پلن را خریداری کند ( عدد 0 یا وارد نکردن به معنای این میباشد که برای عموم آزاد است )</span>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">بروزرسانی</button>
                <a href="{{ route('packages.index') }}" class="btn btn-default float-left">بازگشت</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@stop
@section('script')
    <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
            $('input[type="checkbox"]').each(function(){
                var self = $(this),
                    label = self.next(),
                    label_text = label.text();

                label.remove();
                self.iCheck({
                    checkboxClass: 'icheckbox_line-green py-2',
                    radioClass: 'iradio_line-green',
                    insert: '<div class="icheck_line-icon"></div>' + label_text
                });
            });
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
@stop
