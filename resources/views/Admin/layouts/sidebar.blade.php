<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adminDashboard') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ user()->avatar }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('resume.me') }}" class="d-block">{{ user()->name() }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                داشبوردها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('adminDashboard') }}" class="nav-link text-warning {{ checkPage('adminDashboard') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>داشبورد ادمین</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('userDashboard') }}" class="nav-link text-primary">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>داشبورد کاربری</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*conversation*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-comments align-middle"></i>
                            @php
                                $pendingC = App\Conversation::where('project_id','!=',null)->where('status','pending')->count();
                            @endphp
                            <p>
                                گفتگو ها
                                <span class="text-warning">({{ $pendingC }})</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('conversation.index') }}" class="nav-link {{ checkPage('conversation.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>آخرین گفتگو ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('conversation.pending') }}" class="nav-link {{ checkPage('conversation.pending') ? 'active' : '' }}">
                                    <i class="fa fa-clock-o nav-icon"></i>
                                    <p>در انتظار تایید ({{ $pendingC }})</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('conversation.rejected') }}" class="nav-link {{ checkPage('conversation.rejected') ? 'active' : '' }}">
                                    <i class="fa fa-close nav-icon"></i>
                                    <p>رد شده</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*project*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-file-text align-middle"></i>
                            <p>
                                پروژه ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('projects.index') }}" class="nav-link {{ checkPage('projects.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>آخرین پروژه ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects.search') }}" class="nav-link {{ checkPage('projects.search') ? 'active' : '' }}">
                                    <i class="fa fa-search nav-icon"></i>
                                    <p>جستجوی پروژه</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects.pending') }}" class="nav-link {{ checkPage('projects.pending') ? 'active' : '' }}">
                                    <i class="fa fa-clock-o nav-icon"></i>
                                    <p>در انتظار تایید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects.canceled') }}" class="nav-link {{ checkPage('projects.canceled') ? 'active' : '' }}">
                                    <i class="fa fa-close nav-icon"></i>
                                    <p>لغو شده</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('projects.closed') }}" class="nav-link {{ checkPage('projects.closed') ? 'active' : '' }}">
                                    <i class="fa fa-check nav-icon"></i>
                                    <p>پایان یافته</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*categories*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list align-middle"></i>
                            <p>
                                دسته بندی ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link {{ checkPage('categories.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دسته بندی ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link {{ checkPage('categories.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد دسته بندی</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*admin/user*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users align-middle"></i>
                            <p>
                                کاربر ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ checkPage('users.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>کاربر ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.search') }}" class="nav-link {{ checkPage('users.search') || checkPage('users.search.post') ? 'active' : '' }}">
                                    <i class="fa fa-search nav-icon"></i>
                                    <p>جستجوی کاربر</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*packages*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-gift align-middle"></i>
                            <p>
                                پکیج ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('packages.index') }}" class="nav-link {{ checkPage('packages.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پکیج ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('packages.create') }}" class="nav-link {{ checkPage('packages.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد پکیج</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*payments*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-money align-middle"></i>
                            <p>
                                حسابداری
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('payments.index') }}" class="nav-link {{ checkPage('payments.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>حسابداری</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.suc') }}" class="nav-link {{ checkPage('payments.suc') ? 'active' : '' }}">
                                    <i class="fa fa-check nav-icon"></i>
                                    <p>پرداخت های موفق</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.unsuc') }}" class="nav-link {{ checkPage('payments.unsuc') ? 'active' : '' }}">
                                    <i class="fa fa-close nav-icon"></i>
                                    <p>پرداخت های ناموفق</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.deposits') }}" class="nav-link {{ checkPage('payments.deposits') ? 'active' : '' }}">
                                    <i class="fa fa-lock nav-icon"></i>
                                    <p>آخرین گروگزاری ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.release') }}" class="nav-link {{ checkPage('payments.release') ? 'active' : '' }}">
                                    <i class="fa fa-key nav-icon"></i>
                                    <p>آخرین آزادسازی ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*withdraws*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-credit-card align-middle"></i>
                            <p>
                                درخواست های واریز
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('withdraws.index') }}" class="nav-link {{ checkPage('withdraws.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>آخرین درخواست ها</p>
                                </a>
                            </li>
                            @php
                                $count = \App\Withdraw::where('status','pending')->count();
                            @endphp
                            <li class="nav-item">
                                <a href="{{ route('withdraws.pending') }}" class="nav-link {{ checkPage('withdraws.pending') ? 'active' : '' }}">
                                    <i class="fa fa-clock-o nav-icon"></i>
                                    <p>در انتظار
                                        @if($count)
                                            <span class="badge badge-warning right">{{ $count }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('withdraws.suc') }}" class="nav-link {{ checkPage('withdraws.suc') ? 'active' : '' }}">
                                    <i class="fa fa-check nav-icon"></i>
                                    <p>واریز های موفق</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('withdraws.canceled') }}" class="nav-link {{ checkPage('withdraws.canceled') ? 'active' : '' }}">
                                    <i class="fa fa-close nav-icon"></i>
                                    <p>واریز های لغو شده</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*skills*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-certificate align-middle"></i>
                            <p>
                                مهارت ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('skills.index') }}" class="nav-link {{ checkPage('skills.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>مهارت ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('skills.create') }}" class="nav-link {{ checkPage('skills.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد مهارت</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*links*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-link align-middle"></i>
                            <p>
                                 پیوند ها <small>(تابلو اعلانات)</small>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('links.index') }}" class="nav-link {{ checkPage('links.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پیوند ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('links.create') }}" class="nav-link {{ checkPage('links.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد پیوند</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*helps*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-info-circle align-middle"></i>
                            <p>
                                راهنمای سایت
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('helps.index') }}" class="nav-link {{ checkPage('helps.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>راهنمای سایت</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('helps.create') }}" class="nav-link {{ checkPage('helps.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد راهنما</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ checkPage('*faqs*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-question-circle align-middle"></i>
                            <p>
                                پرسش های متداول
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('faqs.index') }}" class="nav-link {{ checkPage('faqs.index') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پرسش های متداول</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('faqs.create') }}" class="nav-link {{ checkPage('faqs.create') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>ایجاد پرسش</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.index') }}" class="nav-link {{ checkPage('settings.index') ? 'active' : '' }}">
                            <i class="fa fa-cogs nav-icon"></i>
                            <p>
                                تنظیمات سایت
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
