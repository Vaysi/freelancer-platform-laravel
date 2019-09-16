<div class="col-4 pr-1">
    <div class="sticky-sidebar">
        <div class="card custom" id="quick">
            <div class="card-title d-flex justify-content-between align-items-center">
                <span class="bg-transparent">دسترسی سریع</span>
                <span class="small">{{ project_range($project->price_range) }}</span>
            </div>
            <div class="card-body px-2 pt-3">
                @if(isset($page) && in_array($page,['fte','etf']))
                    <a href="{{ route('user.project.view',['project'=>$project->id]) }}" class="btn btn-outline-info d-block mb-2">مشاهده توضیحات پروژه</a>
                @endif
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>حداقل</span>
                    </span>
                    <span>ضمانت تخصص <span>{{ $project->min_guarantee }}</span> درصد</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>کد پروژه</span>
                    </span>
                    <span>{{ $project->id }}</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>حداقل قیمت</span>
                    </span>
                    <span>{{ money(project_range($project->price_range,true)[0]) }}</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>حداکثر قیمت</span>
                    </span>
                    <span>{{ money(project_range($project->price_range,true)[1]) }}</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>مهلت</span>
                    </span>
                    <span>{{ $project->deadline }} روز</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>تعداد مشاهده</span>
                    </span>
                    <span>{{ $project->views }} بار</span>
                </div>
                <div class="item d-flex justify-content-between border-bottom small pb-2 mb-2">
                    <span>
                        <span class="icon text-danger small"><i class="fa fa-chevron-left"></i></span>
                        <span>وضعیت مناقصه</span>
                    </span>
                    <span class="bg-secondary-3 px-2 rounded-half">{{ publish_status($project,false) }}</span>
                </div>
                <div class="progress mt-3 rounded-half">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ project_status($project,false,true) }}%" aria-valuenow="{{ project_status($project,false,true) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="text-center text-dark-3 mt-2 ">{{ project_status($project,false) }}</div>
        <div class="card custom mt-2 {{ (($project->status == 'open' && !$project->isEmployer()) || ($project->status == 'trust_done' && !$project->isFreelancer() && !$project->isEmployer())) ? 'hide' : '' }}" id="buttons">
            <div class="card-body px-2 pt-3">
                @if($project->status == 'open')
                    @if($project->isEmployer())
                        <div class="my-2">
                            <a href="{{ route('invite.user.to.project',$project->id) }}" class="btn btn-outline-danger w-100 round">
                                <i class="fa fa-check ml-1"></i>
                                دعوت از مجری ها
                            </a>
                        </div>
                        <div class="my-2">
                            <a href="{{ $project->linkedIn() }}" class="btn btn-outline-primary w-100 round">
                                <i class="fa fa-linkedin ml-1"></i>
                                انتشار در لینکدین
                            </a>
                        </div>
                        <div class="my-2">
                            <a href="{{ $project->twitter() }}" class="btn btn-outline-info w-100 round">
                                <i class="fa fa-twitter ml-1"></i>
                                انتشار در توییتر
                            </a>
                        </div>
                        @if(!$project->hire)
                            <div class="my-2">
                                <a href="{{ route('project.convert.hire',['project'=>$project->id]) }}" class="btn btn-outline-success w-100 round">
                                    <i class="fa fa-briefcase ml-1"></i>
                                    تبدیل به آگهی استخدام / اعلان
                                </a>
                            </div>
                        @endif
                        @if(!$project->urgent)
                            <div class="my-2">
                                <a href="{{ route('project.convert.urgent',['project'=>$project->id]) }}" class="btn btn-outline-danger w-100 round">
                                    <i class="fa fa-thumbs-up ml-1"></i>
                                    زدن برچسب فوری
                                </a>
                            </div>
                        @endif
                        @if(!$project->special)
                            <div class="my-2">
                                <a href="{{ route('project.convert.special',['project'=>$project->id]) }}" class="btn btn-outline-warning w-100 round">
                                    <i class="fa fa-star ml-1"></i>
                                    بالا بردن جذابیت آگهی
                                </a>
                            </div>
                        @endif
                        @if(!$project->hidden)
                            <div class="my-2">
                                <a href="{{ route('project.convert.hidden',['project'=>$project->id]) }}" class="btn btn-outline-secondary w-100 round">
                                    <i class="fa fa-eye ml-1"></i>
                                    مخفی کردن از دید گوگل
                                </a>
                            </div>
                        @endif
                    @endif
                @endif
                @if($project->status == 'closed')
                    @if($project->isFreelancer())
                        @if(!boolval($project->employer_score))
                            <div class="my-2">
                                <button class="btn btn-outline-success w-100 round" data-toggle="modal" data-target="#makeVote">
                                    <i class="fa fa-thumbs-up ml-1"></i>
                                    رای به کارفرما
                                </button>
                            </div>
                        @endif
                    @else
                        @if(!boolval($project->freelancer_score))
                            <div class="my-2">
                                <button class="btn btn-outline-success w-100 round" data-toggle="modal" data-target="#makeVote">
                                    <i class="fa fa-thumbs-up ml-1"></i>
                                    رای به مجری
                                </button>
                            </div>
                        @endif
                    @endif
                @endif
                @if($project->status == 'emp_trust' && $project->isEmployer() && $project->offer_id)
                    <div class="my-2">
                        <a href="{{ route('project.prepayment',['project' => $project->id]) }}" class="btn btn-danger w-100 round blinker btn-ask">
                            <i class="fa fa-money ml-1"></i>
                            گروگزاری وجه
                        </a>
                    </div>
                @endif
                @if($project->deposit < 100 && $project->isEmployer() && $project->offer_id)
                    <div class="my-2">
                        <a href="{{ route('user.project.deposits',['project' => $project->id]) }}" class="btn btn-danger w-100 round btn-ask">
                            <i class="fa fa-money ml-1"></i>
                            گروگزاری وجه
                        </a>
                    </div>
                @endif
                @if($project->status == 'flc_trust' && $project->isFreelancer())
                        <div class="my-2">
                            <a href="{{ route('project.warranty',['project' => $project->id]) }}" class="btn btn-danger w-100 round blinker btn-ask">
                                <i class="fa fa-money ml-1"></i>
                                گروگزاری وجه
                            </a>
                        </div>
                @endif
                @if($project->status == 'trust_done')
                    @if($project->isFreelancer())
                        <div class="my-2">
                            <button class="btn btn-outline-success w-100 round deliverIt">
                                <i class="fa fa-check ml-1"></i>
                                اعلام پایان کار
                            </button>
                        </div>
                    @endif
                    @if($project->isEmployer())
                        @if(!$project->hire)
                            <div class="my-2">
                                <a href="{{ route('project.convert.hire',['project'=>$project->id]) }}" class="btn btn-outline-success w-100 round">
                                    <i class="fa fa-briefcase ml-1"></i>
                                    تبدیل به آگهی استخدام / اعلان
                                </a>
                            </div>
                        @endif
                    @endif
                @endif
                @if(in_array($project->status,['flc_done','trust_done']))
                    @if($project->isEmployer())
                        <div class="my-2">
                            <a href="{{ route('project.confirm',['project'=>$project->id]) }}" class="btn btn-ask btn-outline-success w-100 round">
                                <i class="fa fa-check ml-1"></i>
                                تایید پروژه مجری
                            </a>
                        </div>
                        <div class="my-2">
                            <a href="{{ route('project.release',['project'=>$project->id]) }}" class="btn btn-ask btn-outline-info w-100 round">
                                <i class="fa fa-money ml-1"></i>
                                آزاد سازی وجه
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@section('body')
    @if(($project->isEmployer() && !boolval($project->freelancer_score)) || ($project->isFreelancer() && !boolval($project->employer_score)))
        <div class="modal fade" id="makeVote" tabindex="-1" role="dialog" aria-labelledby="makeVote" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $project->isEmployer() ? 'رای به مجری' : 'رای به خریدار' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-right">
                        <form action="{{ route('project.vote',['project'=>$project->id]) }}" class="round" id="vote" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="point">امتیاز</label>
                                        <select name="point" id="point" class="selectpicker w-100" title="امتیاز را مشخص کنید">
                                            <option value="3" class="text-danger">ضعیف</option>
                                            <option value="4">زیر متوسط</option>
                                            <option value="5">متوسط</option>
                                            <option value="6">بالای متوسط</option>
                                            <option value="7" class="text-info">خوب</option>
                                            <option value="8">خیلی خوب</option>
                                            <option value="9">عالی</option>
                                            <option value="10" class="text-success">ممتاز</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="comment">امتیاز</label>
                                        <textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button form="vote" class="btn btn-primary">ثبت رای</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
