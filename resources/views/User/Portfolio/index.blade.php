@extends('User.master')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12 mb-3" id="portfolio">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between">
                        <span>نمونه کارهای ثبت شده</span>
                        <a href="{{ route('portfolio.create') }}" class="btn btn-outline-info round btn-sm">ارسال نمونه کار</a>
                    </div>
                    <div class="card-body py-3">
                        <div class="row row-eq-height" id="portfolio_list">
                            @foreach($portfolios as $portfolio)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 port_item mb-2">
                                    <a href="{{ route('portfolio.show',['portfolio'=>$portfolio->id]) }}" class="d-block h-100 w-100 position-relative">
                                        <img src="{{ asset($portfolio->images[0]) }}" class="rounded-half border">
                                        <div class="overlay d-flex justify-content-center align-items-center flex-column w-100 h-100 text-center position-absolute">
                                            <span class="h5 text-white">{{ limit($portfolio->title,20) }}</span>
                                            <span class="text-white-50 h6 mt-1">جزئیات بیشتر</span>
                                            <div class="flow">{!! portfolioStatus($portfolio) !!}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
