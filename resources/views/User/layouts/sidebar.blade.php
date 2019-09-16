<div id="sidebar">
    <div class="wrapper text-white">
        <div class="text-center mb-3">
            <span class="typographic h5">پنل کاربری</span>
        </div>
        <hr class="mb-0">
        <nav class="nav flex-column menu">
            @if(user()->admin)
            <a class="nav-link text-warning" href="{{ route('adminDashboard') }}" >
                <span class="icon"><i class="fa fa-user-secret"></i></span>
                داشبورد مدیریت
            </a>
            @endif
            <a class="nav-link {{ checkPage('userDashboard') }}" href="{{ route('userDashboard') }}" >
                <span class="icon"><i class="fa fa-bars"></i></span>
                داشبورد
            </a>
            <a class="nav-link has-dropdown {{ checkPage('*project*') }}" href="#">
                <span class="icon"><i class="fa fa-file"></i></span>
                پروژه ها
            </a>
            <div class="submenu {{ checkPage('*project*',true) ? 'show active' : '' }}">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('user.project.new') }}" class="nav-link {{ checkPage('user.project.new') }}">
                            <span class="icon"><i class="fa fa-plus"></i></span>
                            سفارش پروژه
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.all') }}" class="nav-link {{ checkPage('user.projects.all') }}">
                            <span class="icon"><i class="fa fa-list"></i></span>
                            همه پروژه های باز
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.related') }}" class="nav-link {{ checkPage('user.projects.related') }}">
                            <span class="icon"><i class="fa fa-bullseye"></i></span>
                            مرتبط با تخصص من
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.urgent') }}" class="nav-link {{ checkPage('user.projects.urgent') }}">
                            <span class="icon"><i class="fa fa-fire"></i></span>
                            پروژه های فوری
                            <span class="badge badge-danger">فوری</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.special') }}" class="nav-link {{ checkPage('user.projects.special') }}">
                            <span class="icon"><i class="fa fa-volume-up"></i></span>
                            پروژه های ویژه
                            <span class="badge badge-warning">ویژه</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.hire') }}" class="nav-link {{ checkPage('user.projects.hire') }}">
                            <span class="icon"><i class="fa fa-magnet"></i></span>
                            آگهی استخدام
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.projects.done') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-circle-o-notch"></i></span>
                            انجام شده یا در حال انجام
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link has-dropdown" href="#">
                <span class="icon"><i class="fa fa-handshake-o"></i></span>
                کارفرما
            </a>
            <div class="submenu">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('employer.requests') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-file"></i></span>
                            درخواست های من
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.find') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-search"></i></span>
                            یافتن مجری
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.judge') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-gavel"></i></span>
                            درخواست های داوری
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link has-dropdown" href="#">
                <span class="icon"><i class="fa fa-user-secret"></i></span>
                مجری
            </a>
            <div class="submenu">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('freelancer.requests') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-file"></i></span>
                            پیشنهاد های من
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('freelancer.judge') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-gavel"></i></span>
                            درخواست های داوری
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('portfolio.index') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-briefcase"></i></span>
                            نمونه کار های من
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('premium') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-gift"></i></span>
                            حساب کاربری ویژه
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link has-dropdown {{ checkPage('*financial*') }}" href="#">
                <span class="icon"><i class="fa fa-google-wallet"></i></span>
                امور مالی
            </a>
            <div class="submenu {{ checkPage('*financial*',true) ? 'show active' : '' }}">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('money.index') }}" class="nav-link {{ checkPage('money.index') }}">
                            <span class="icon"><i class="fa fa-list"></i></span>
                            گزارش مالی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('money.add') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-plus"></i></span>
                            افزایش موجودی حساب
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('money.edit') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-google-wallet"></i></span>
                            ویرایش اطلاعات مالی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('money.withdraw') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-exchange"></i></span>
                            درخواست واریز
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link has-dropdown" href="#">
                <span class="icon"><i class="fa fa-headphones"></i></span>
                پشتیبانی
            </a>
            <div class="submenu">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('rules') }}" class="nav-link text-warning">
                            <span class="icon"><i class="fa fa-book"></i></span>
                            قوانین سایت
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('help') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-question-circle-o"></i></span>
                            راهنمای سایت
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('support') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-list"></i></span>
                            درخواست های من
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('faq') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-question"></i></span>
                            پرسش های متداول
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-info"></i></span>
                            درباره ما
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('support.contact') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-phone"></i></span>
                            تماس با ما
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="my-2">
            <a class="nav-link has-dropdown" href="#">
                <span class="icon"><i class="fa fa-user"></i></span>
                پروفایل من
            </a>
            <div class="submenu">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('resume.me') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-image"></i></span>
                            نمایش رزومه
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('resume.edit') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-edit"></i></span>
                            ویرایش رزومه
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('avatar') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-user-circle"></i></span>
                            تغیر آواتار
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-file-code-o"></i></span>
                            ویرایش اطلاعات پایه
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link has-dropdown" href="#">
                <span class="icon"><i class="fa fa-user-plus"></i></span>
               کسب درامد
            </a>
            <div class="submenu">
                <ul class="nav flex-column pr-0 mr-0 isDropdown">
                    <li class="nav-item">
                        <a href="{{ route('affiliate.invite') }}" class="nav-link text-warning">
                            <span class="icon"><i class="fa fa-envelope-o"></i></span>
                            دعوت از دوستان
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('affiliate.banner') }}" class="nav-link">
                            <span class="icon"><i class="fa fa-file-code-o"></i></span>
                            از طریق تلگرام یا بنر
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fa fa-eye"></i></span>
                            آمار عملکرد
                        </a>
                    </li>
                </ul>
            </div>
            <a class="nav-link" href="#">
                <span class="icon"><i class="fa fa-files-o"></i></span>
                وبلاگ
            </a>

        </nav>
    </div>
</div>
