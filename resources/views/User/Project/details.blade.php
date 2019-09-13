<div class="row">
    <div class="col-12 mb-3" id="projectDetails">
        <div class="card custom">
            <div class="card-title">
                <span>
                    پیام ها میان خریدار
                    <span><a href="{{ $project->user->resumeLink() }}">{{ $project->user->name() }}</a></span>
                    و مجری
                    <span><a href="{{ optional($project->freelancer)->resumeLink() ?? user()->resumeLink() }}">{{ optional($project->freelancer)->name() ?? user()->name() }}</a></span>
                </span>
            </div>
            <hr class="my-0 mb-2">
            <div class="card-body">
                @if($project->hasOffer($page == 'fte' ? null : $user))
                    @if($page == 'fte')
                        @if(optional($project->finalOffer())->id != user()->offer($project)->id)
                            <div class="alert alert-info rounded-corner-5">
                                <div class="row row-eq-height">
                                    <div class="col-2 icon display-4 text-center">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    @php
                                        $offer = $project->offer();
                                    @endphp
                                    <div class="col-10">
                                        <span class="bold h5">شما برای این پروژه پیشنهاد ارسال کردید</span>
                                        <div class="h6">
                                            <p class="mb-1"> مبلغ پیشنهادی شما : <span>{{ money($offer->price) }}</span></p>
                                            <p class="mb-1"> مبلغ عایدی شما :  <span>{{ money(getPercent($offer->price,15)) }}</span></p>
                                            <p class="mb-1"> مقدار گروگزاری : <span>{{ $offer->prepayment }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->prepayment,true)) }}</span></p>
                                            <p class="mb-1"> ضمانت تخصص پیشنهادی : <span>{{ $offer->warranty }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->warranty,true)) }}</span></p>
                                            <p class="mb-1"> زمان اجرا : <span>{{ $offer->deadline }} روز </span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion mt-4 row" id="accordionExample">
                                <div class="col-12">
                                    <div class="card mb-2 rounded-half">
                                        <div class="card-header rounded-half" id="headingOne">
                                            <h4 class="mb-0 w-100">
                                                <button class="btn small btn-link w-100 d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <span>ویرایش پیشنهاد قیمت</span>
                                                    <h5 class="text-dark-2 mb-0"><i class="fa fa-chevron-down"></i></h5>
                                                </button>
                                            </h4>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <form action="{{ route('conversations.fte.store',['project' => $project->id]) }}" class="corner" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="price" class="form-label">مبلغ پیشنهاد :</label>
                                                        <div class="input-group mb-1">
                                                            <input id="price" value="{{ $offer->price ?? old('price') }}" name="price" type="number" min="0" step="5000" class="form-control" placeholder="مبلغ پیشنهاد" aria-label="مبلغ پیشنهاد" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info text-white" id="basic-addon2">تومان</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group collapse">
                                                        <label for="prepayment" class="form-label">پیش پرداخت :</label>
                                                        <div class="input-group mb-1">
                                                            <input id="prepayment" value="{{ $offer->prepayment ?? old('prepayment') ?? '0' }}" name="prepayment" type="number" min="0" step="5" max="100" class="form-control" placeholder="پیش پرداخت" aria-label="پیش پرداخت" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="warranty" class="form-label">ضمانت تخصص :</label>
                                                        <div class="input-group mb-1">
                                                            <input id="warranty" value="{{ $offer->warranty ?? old('warranty') ?? $project->min_guarantee }}" name="warranty" type="number" min="{{ $project->min_guarantee }}" step="5" max="100" class="form-control" placeholder="ضمانت تخصص" aria-label="ضمانت تخصص" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                                            </div>
                                                        </div>
                                                        @if($project->min_guarantee > 0)
                                                            <small class="text-mute form-text">حداقل ضمانت تخصص این پروژه <span class="font-weight-bold text-danger">{{ $project->min_guarantee }} درصد</span> میباشد</small>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deadline">مهلت انجام :</label>
                                                        <div class="input-group mb-1">
                                                            <input id="deadline" value="{{ $offer->deadline ?? old('deadline') }}" name="deadline" type="number" class="form-control" placeholder="مهلت تحویل پروژه" aria-label="محلت تحویل پروژه" aria-describedby="basic-addon2">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info text-white" id="basic-addon2">روز</span>
                                                            </div>
                                                        </div>
                                                        @if($project->min_guarantee > 0)
                                                            <small class="text-mute form-text">حداکثر مدت زمان تحویل این پروژه <span class="font-weight-bold text-danger">{{ $project->deadline }} روز</span> میباشد</small>
                                                        @endif
                                                    </div>
                                                    <div class="form-group d-flex justify-content-between">
                                                        <button class="btn btn-outline-info w-50">ویرایش پیشنهاد</button>
                                                        <a href="{{ route('conversations.fte.delete',['project'=>$project->id]) }}" class="btn btn-outline-danger w-50 mr-2">لغو پیشنهاد</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success rounded-corner-5">
                                <div class="row row-eq-height">
                                    <div class="col-2 icon display-4 text-center">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    @php
                                        $offer = $project->offer();
                                    @endphp
                                    <div class="col-10">
                                        <span class="bold h5">پیشنهاد شما پذیرفته شد</span>
                                        <div class="h6">
                                            <p class="mb-1"> مبلغ پیشنهادی شما : <span>{{ money($offer->price) }}</span></p>
                                            <p class="mb-1"> مبلغ عایدی شما :  <span>{{ money(getPercent($offer->price,15)) }}</span></p>
                                            <p class="mb-1"> مقدار گروگزاری : <span>{{ $offer->prepayment }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->prepayment,true)) }}</span></p>
                                            <p class="mb-1"> ضمانت تخصص پیشنهادی : <span>{{ $offer->warranty }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->warranty,true)) }}</span></p>
                                            <p class="mb-1"> زمان اجرا : <span>{{ $offer->deadline }} روز </span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if(optional($project->finalOffer())->id != $user->offer($project)->id)
                        <div class="alert alert-info rounded-corner-5">
                            <div class="row row-eq-height">
                                <div class="col-2 icon display-4 text-center">
                                    <i class="fa fa-money"></i>
                                </div>
                                @php
                                $offer = $user->offer($project);
                                @endphp
                                <div class="col-10">
                                    <span class="bold h5">پیشنهاد مجری</span>
                                    <div class="h6">
                                        <p class="mb-1"> مبلغ پیشنهادی مجری : <span>{{ money($offer->price) }}</span></p>
                                        <p class="mb-1"> مقدار گروگزاری شما : <span>{{ $offer->prepayment }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->prepayment,true)) }}</span></p>
                                        <p class="mb-1"> ضمانت تخصص پیشنهادی ( گروگزاری مجری ) : <span>{{ $offer->warranty }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->warranty,true)) }}</span></p>
                                        <p class="mb-1"> زمان اجرا : <span>{{ $offer->deadline }} روز </span></p>
                                    </div>
                                    @if($project->status == 'open')
                                    <form method="post" action="{{ route('project.accept.offer',['project'=>$project->id,'offer'=>$offer->id]) }}">
                                        @csrf
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-outline-info round btn-ask w-100">پذیرش پیشنهاد</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-success rounded-corner-5">
                                <div class="row row-eq-height">
                                    <div class="col-2 icon display-4 text-center">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    @php
                                        $offer = $user->offer($project);
                                    @endphp
                                    <div class="col-10">
                                        <span class="bold h5">شما این پیشنهاد رو پذیرفته اید</span>
                                        <div class="h6">
                                            <p class="mb-1"> مبلغ پیشنهادی مجری : <span>{{ money($offer->price) }}</span></p>
                                            <p class="mb-1"> مقدار گروگزاری شما : <span>{{ $offer->prepayment }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->prepayment,true)) }}</span></p>
                                            <p class="mb-1"> ضمانت تخصص پیشنهادی ( گروگزاری مجری ) : <span>{{ $offer->warranty }}%</span> معادل <span>{{ money(getPercent($offer->price,$offer->warranty,true)) }}</span></p>
                                            <p class="mb-1"> زمان اجرا : <span>{{ $offer->deadline }} روز </span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @else
                @if(!$project->isEmployer())
                    <form action="{{ route('conversations.fte.store',['project' => $project->id]) }}" class="corner" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="price" class="form-label">مبلغ پیشنهاد :</label>
                                <div class="input-group mb-1">
                                    <input id="price" value="{{ old('price') }}" name="price" type="number" min="0" step="5000" class="form-control" placeholder="مبلغ پیشنهاد" aria-label="مبلغ پیشنهاد" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">تومان</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group collapse">
                                <label for="prepayment" class="form-label">پیش پرداخت :</label>
                                <div class="input-group mb-1">
                                    <input id="prepayment" value="{{ old('prepayment') ?? '0' }}" name="prepayment" type="number" min="0" step="5" max="100" class="form-control" placeholder="پیش پرداخت" aria-label="پیش پرداخت" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="warranty" class="form-label">ضمانت تخصص :</label>
                                <div class="input-group mb-1">
                                    <input id="warranty" value="{{ old('warranty') ?? $project->min_guarantee }}" name="warranty" type="number" min="{{ $project->min_guarantee }}" step="5" max="100" class="form-control" placeholder="ضمانت تخصص" aria-label="ضمانت تخصص" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">درصد</span>
                                    </div>
                                </div>
                                @if($project->min_guarantee > 0)
                                    <small class="text-mute form-text">حداقل ضمانت تخصص این پروژه <span class="font-weight-bold text-danger">{{ $project->min_guarantee }} درصد</span> میباشد</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="deadline">مهلت انجام :</label>
                                <div class="input-group mb-1">
                                    <input id="deadline" value="{{ old('deadline') }}" name="deadline" type="number" class="form-control" placeholder="مهلت تحویل پروژه" aria-label="محلت تحویل پروژه" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2">روز</span>
                                    </div>
                                </div>
                                @if($project->min_guarantee > 0)
                                    <small class="text-mute form-text">حداکثر مدت زمان تحویل این پروژه <span class="font-weight-bold text-danger">{{ $project->deadline }} روز</span> میباشد</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="content" class="form-label">توضیحات</label>
                                <textarea type="text" name="content" class="form-control" id="content" rows="5">{{ old('content') }}</textarea>
                                <label for="attachment2" class="mt-2 mb-1">ضمیمه فایل</label>
                                <input type="file" name="file[]" id="attachment2" class="filepond" multiple data-max-file-size="3MB">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-info w-100">ارسال پیشنهاد / توضیح</button>
                            </div>
                        </form>
                @endif
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
                @endif
                @endif
                @if($project->status == 'emp_trust' && $project->isEmployer())
                    <div class="alert alert-yellow rounded-corner-5">
                        <div class="row row-eq-height">
                            <div class="col-2 icon display-4 text-center">
                                <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="col-10">
                                <span class="bold h5">نوبت شماست که گروگزاری کنید</span>
                                <p class="h6">برای شروع به کار مجری , نیاز هست تا شما مبلغ <span class="bold">{{ money(getPercent($project->finalOffer()->price,$project->finalOffer()->prepayment,true)) }}</span> را در وبسایت گرو بگذارید !</p>
                            </div>
                        </div>
                    </div>
                @elseif($project->status == 'flc_trust' && $project->isFreelancer())
                    <div class="alert alert-yellow rounded-corner-5">
                        <div class="row row-eq-height">
                            <div class="col-2 icon display-4 text-center">
                                <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="col-10">
                                <span class="bold h5">نوبت شماست که گروگزاری کنید</span>
                                <p class="h6">برای شروع به کار , نیاز هست تا شما مبلغ <span class="bold">{{ money(getPercent($project->finalOffer()->price,$project->finalOffer()->warranty,true)) }}</span> را در وبسایت گرو بگذارید !</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
