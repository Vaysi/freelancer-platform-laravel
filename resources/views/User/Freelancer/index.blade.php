@extends('User.master')
@section('content')
    <div class="col-3 pl-1">
        <div class="card custom sticky-sidebar">
            <div class="card-title">
                <span><i class="fa fa-search align-middle"></i> فیلتر کردن نتایج</span>
            </div>
            <div class="card-body " >
                <form action="{{ route('employer.requests.filter') }}" method="post" class="corner">
                    @csrf
                    <div class="form-group">
                        <label for="status">وضعیت پروژه</label>
                        <select name="status" id="status" class="selectpicker w-100">
                            <option value="all">همه پیشنهاد ها</option>
                            <option value="">پذیرفته شده ( انجام شده )</option>
                            <option value="">پذیرفته شده ( در حال انجام )</option>
                            <option value="">در جریان</option>
                            <option value="">پذیرفته نشده</option>
                            <option value="">لغو شده</option>
                            <option value="">توضیحات ( بدون قیمت )</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn-info btn">نمایش بده</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-9 pr-1">
        <div class="row">
            <div class="col-12 mb-3" id="emp_req">
                <div class="card custom">
                    <div class="card-title">
                        <span> <i class="fa fa-list align-middle"></i> فهرست درخواست های ثبت شده از سوی شما | <span class="text-danger">24 مورد</span></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table normal">
                                <thead>
                                <tr>
                                    <th scope="col" width="13%">کد پروژه</th>
                                    <th scope="col" width="35%">عنوان پروژه</th>
                                    <th scope="col" width="15%">پیشنهاد</th>
                                    <th scope="col" width="20%">وضعیت پروژه</th>
                                    <th scope="col" width="17%">نوع پروژه</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                    <a href="{{ route('') }}" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        بدون قیمت
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        بدون قیمت
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><small>321515</small></th>
                                    <td>
                                        <a href="#" class="text-dark small">طراحی وبسایت در زمینه واسطه گری در پروژه های مجری و کارفرما</a>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info round">2,8000,000 تومان</button>
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>در حال انجام</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info rounded-half">معمولی</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination justify-content-center h6 small pr-0 mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fa fa-angle-double-right"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
