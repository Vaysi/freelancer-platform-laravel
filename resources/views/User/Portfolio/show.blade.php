@extends('User.master')
@section('content')
    <div class="col-8">
        <div class="row">
            <div class="col-12 mb-3" id="portfolio">
                <div class="card custom">
                    <div class="card-title d-flex justify-content-between">
                        <span>تصاویر</span>
                        @if($portfolio->user->id == user()->id)
                            <a href="{{ route('portfolio.edit',['portfolio'=>$portfolio->id]) }}" class="btn btn-outline-danger blinker round btn-sm">ویرایش نمونه کار</a>
                        @endif
                    </div>
                    <div class="card-body py-3">
                        @if($portfolio->message)
                            <div class="alert alert-danger">
                                <span class="bold">علت رد شدن :</span>  {{ $portfolio->message }}
                            </div>
                        @endif
                        <div>
                            <ul class="gallery p-0 text-center">
                                @foreach($portfolio->withoutThumb() as $image)
                                    <li>
                                        <img
                                            src="{{ asset($image) }}"
                                            data-gallery-src="{{ asset($image) }}"
                                            data-gallery-desc="{{ "تصویر شماره " . $loop->iteration }}"
                                            alt="{{ "تصویر شماره " . $loop->iteration }}"
                                            class="border rounded"
                                        >
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4" id="details">
        <div class="card custom">
            <div class="card-title {{ $portfolio->isTheCreator() ? 'd-flex justify-content-between' : '' }}">
                <span>جزئیات</span>
                @if($portfolio->isTheCreator())
                <div>
                    {!! portfolioStatus($portfolio) !!}
                </div>
                @endif
            </div>
            <div class="card-body py-2">
                <a href="{{ route('resume.view',['user'=>$portfolio->user->id]) }}" class="text-center d-block w-100">
                    <img src="{{ $portfolio->user->avatar }}" class="rounded-circle w-50 px-4 d-block mx-auto mb-2">
                    <span class="text-info pt-2">{{ $portfolio->user->nicky }}</span>
                </a>
                <p class="mt-3 d-block mx-auto w-75 small">
                    {{ $portfolio->description }}
                </p>
                <div class="text-left">
                    <span class="small text-secondary">{{ jdate($portfolio->created_at)->format('d F Y') }}</span>
                </div>
                <hr>
                <span class="title-caption">مهارت های استفاده شده</span>
                <div class="my-2">
                    @foreach($portfolio->skills()->take(8)->get() as $skill)
                        <button class="btn btn-outline-danger btn-sm ml-2 mb-2 rounded-half">{{ $skill->name }}</button>
                    @endforeach
                </div>
                <hr>
                <div class="d-flex justify-content-between w-75 mx-auto">
                    <div class="text-center pointer" @click="like">
                        <span class="d-block h4" :class="{'text-dark': isUserLike < 1,'text-danger': isUserLike > 0}">
                            <i class="fa" :class="{'fa-heart-o': isUserLike < 1,'fa-heart animated tada': isUserLike > 0}"></i>
                        </span>
                        <span class="d-block small">@{{ liked }}</span>
                    </div>
                    <div class="text-center">
                        <span class="text-info d-block h4">
                            <i class="fa fa-eye"></i>
                        </span>
                        <span class="d-block small">{{ $portfolio->views }} بازدید </span>
                    </div>
                </div>
                <a href="{{ route('resume.view',['user'=>$portfolio->user->id]) }}" class="btn btn-outline-info w-100 mt-3 round">بازگشت به لیست نمونه کار ها</a>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .gallery { display: grid; list-style: none; grid-template-columns: 2fr 1fr; grid-gap: 1rem; max-width: 46rem; width: 100%; }
        .gallery > li:first-child { grid-row: 1 / span 2 }
        .gallery img { display: block; width: 100%; height: 100%; object-fit: cover;cursor: pointer; }
    </style>
@endsection
@section('js')
    <script>
        const app = new Vue({
            el: "#details",
            data : {
                liked : parseInt("{{ $portfolio->liked }}"),
                isUserLike: JSON.parse("{{ $portfolio->isLiked() == 0 ? "false" : $portfolio->isLiked() }}"),
                url: "{{ route('portfolio.like',['portfolio'=>$portfolio->id]) }}"
            },
            methods: {
                like(){
                    let app = this;
                    axios.post(this.url).then((resp) => {
                        app.liked = parseInt(resp.data.liked);
                        app.isUserLike = JSON.parse(resp.data.isLiked);
                    });
                },
            }
        });
    </script>
@stop
