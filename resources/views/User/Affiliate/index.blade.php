@extends('User.master')
@section('content')
    <div class="col-9 pl-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span>دوستان خود را دعوت کنید</span>
                    </div>
                    <div class="card-body">
                        <h6 class="text-dark small pr-2 mb-0 font-weight-bold mt-2">برای کدام مخاطب دعوتنامه ارسال شود ؟ </h6>
                        <small><small class="d-block text-info font-weight-bold pr-2">درامد من به چه صورت خواهد بود ؟</small></small>
                        <div class="d-flex justify-content-around mt-2">
                            <div>
                                <a href="#"><img src="{{ asset('images/search.png') }}"></a>
                            </div>
                            <div>
                                <a href="#"><img src="{{ asset('images/linkedin.png') }}"></a>
                            </div>
                        </div>
                        <div class="accordion mt-4" id="accordionExample">
                            <div class="card mb-2 rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center align-items-center" id="headingOne">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            لیست مخاطبینی که از قبل عوض عضو پروژستان شدند | <span class="text-danger">2 نفر</span>
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-half">
                                <div class="card-header rounded-half d-flex justify-content-between align-items-center" id="headingTwo">
                                    <h4 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            لیست مخاطبینی که میتوانید دعوت کنید | <span class="text-danger">27 نفر</span>
                                        </button>
                                    </h4>
                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 pr-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span> کاربران ثبت نام شده از طریق شما </span>
            </div>
            <div class="card-body text-center" >
                <div style="height: 70px;" class="d-flex justify-content-center align-items-center font-weight-bold text-info">
                    <span>{{ user()->references()->count() }}  نفر</span>
                </div>
                <a href="{{ route('affiliate.report') }}" class="btn btn-info round mt-2">آمار عملکرد</a>
            </div>
        </div>
    </div>
@stop
