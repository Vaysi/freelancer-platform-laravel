@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>تماس با ما</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <span class="small">{{ option('contact_text_1') }}</span>
                                <div class="bg-secondary-3 rounded-corner-2-half py-4 px-3 my-2">
                                    <span class="text-dark-3 d-block">
                                        <span class="icon ml-2"><i class="fa fa-map-marker"></i></span>
                                        آدرس دفتر مرکزی :
                                    </span>
                                    <span class="pr-4 d-block small mt-3">{{ option('contact_address') }}</span>
                                    <span class="text-dark-3 d-block mt-4">
                                        <span class="icon ml-2"><i class="fa fa-phone"></i></span>
                                        تلفن :
                                    </span>
                                    <span class="pr-4 d-block  mt-3">
                                        {!! option('contact_phone') !!}
                                    </span>
                                    <span class="text-dark-3 d-block mt-4">
                                        <span class="icon ml-2"><i class="fa fa-envelope-o"></i></span>
                                        ایمیل :
                                    </span>
                                    <span class="pr-4 d-block  mt-3">
                                        <span class="d-block">
                                            <span>{{ option('contact_email') }}</span>
                                        </span>
                                    </span>
                                    <ul class="nav justify-content-center p-0 mt-3" id="social">
                                        @if(option('contact_gplus'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ option('contact_gplus') }}" data-toggle="tooltip" data-placement="top" title="گوگل پلاس"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        @endif
                                        @if(option('contact_linkedin'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ option('contact_linkedin') }}" data-toggle="tooltip" data-placement="top" title="لینکدین"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                        @endif
                                        @if(option('contact_instagram'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ option('contact_instagram') }}" data-toggle="tooltip" data-placement="top" title="اینستاگرام"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        @endif
                                        @if(option('contact_telegram'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ option('contact_telegram') }}" data-toggle="tooltip" data-placement="top" title="تلگرام"><i class="fa fa-telegram"></i></a>
                                        </li>
                                        @endif
                                        @if(option('contact_facebook'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ option('contact_facebook') }}" data-toggle="tooltip" data-placement="top" title="فیسبوک"><i class="fa fa-facebook-f"></i></a>
                                        </li>
                                        @endif
                                        @if(option('contact_twitter'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ option('contact_twitter') }}" data-toggle="tooltip" data-placement="top" title="توییتر"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-4">
                                <form action="" class="corner">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="subject" class="col-sm-3 col-form-label">عنوان</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="subject">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">نام</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">ایمیل</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">نوع</label>
                                        <div class="col-sm-9">
                                            <select name="type" id="type" class="selectpicker w-100">
                                                <option value="">پیشنهاد</option>
                                                <option value="">انتقاد</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="message" class="col-sm-3 col-form-label">پیام</label>
                                        <div class="col-sm-9">
                                            <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="message" class="col-sm-3"></label>
                                        <div class="col-9">
                                            <button class="btn btn-info w-100">ارسال</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-12">
                                <div id="osMap" class="w-100 rounded-half"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        let lat = parseFloat("{{ option('contact_mapLat') ?? "35.688812" }}");
        let long = parseFloat("{{ option('contact_mapLong') ?? "51.403828" }}");
        let mymap = L.map('osMap').setView([lat,long], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="http://Projestan.ir">wWw.Projestan.iR</a> &copy; 2019'
        }).addTo(mymap);
        L.marker([lat,long]).addTo(mymap)
            .bindPopup('{{ option("contact_mapText") ?? "شرکت پروژستان | شرکت گروگزاری امن مالی" }}')
            .openPopup();
    </script>
@stop
