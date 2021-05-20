<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo.png" class="navbar-brand-img"
                alt="WATCHAN ERP"> WATCHAN 4.0
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder"
                                src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">
                            {{ __('ยินดีต้อนรับ!') }}
                        </h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('ข้อมูลส่วนตัว') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power"></i>
                        <span>{{ __('ออกจากระบบ') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li
                    class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-tachometer-alt text-primary"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            <h6 class="navbar-heading text-muted">เมนูระบบแยกตามกลุ่มงาน</h6>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-ipd" data-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="navbar-ipd">
                        <i class="fas fa-bed text-info"></i>
                        <span
                            class="nav-link-text">{{ __('งานผู้ป่วยใน') }}
                        </span>
                    </a>
                    <div class="collapse {{ (request()->is('drugOrder','foodOrder')) ? 'show' : '' }} {{ (request()->is('drugOrder/*','foodOrder/*')) ? 'show' : '' }}"
                        id="navbar-ipd">
                        <ul class="nav nav-sm flex-column">
                            <li
                                class="nav-item {{ (request()->is('drugOrder')) ? 'active' : '' }} {{ (request()->is('drugOrder/createDrugOrder')) ? 'active' : '' }}">
                                <a class="nav-link" href="/drugOrder">
                                    ระบบออเดอร์ผู้ป่วย
                                </a>
                            </li>
                            <li
                                class="nav-item {{ (request()->is('foodOrder')) ? 'active' : '' }} {{ (request()->is('foodOrder/*')) ? 'active' : '' }} {{ (request()->is('foodOrder/createFoodOrder')) ? 'active' : '' }} ">
                                <a class="nav-link" href="/foodOrder">
                                    ระบบสั่งอาหารผู้ป่วย
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-er" data-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="navbar-er">
                        <i class="fas fa-ambulance text-danger"></i>
                        <span
                            class="nav-link-text">{{ __('งานอุบัติเหตุและฉุกเฉิน') }}
                        </span>
                    </a>
                    <div class="collapse {{ (request()->is('er')) ? 'show' : '' }} {{ (request()->is('er/*')) ? 'show' : '' }}"
                        id="navbar-er">
                        <ul class="nav nav-sm flex-column">
                            <li
                                class="nav-item {{ (request()->is('ems','er/create_ems')) ? 'active' : '' }} {{ (request()->is('er/ems*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/er/ems">
                                    รายงานข้อมูล EMS
                                </a>
                            </li>
                            <li
                                class="nav-item {{ (request()->is('refer')) ? 'active' : '' }} {{ (request()->is('er/refer*')) ? 'active' : '' }}">
                                <a class="nav-link" href="/er/refer">
                                    รายงานข้อมูล REFER
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-office" data-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="navbar-office">
                        <i class="fas fa-folder-open text-success"></i>
                        <span
                            class="nav-link-text">{{ __('ระบบงานเวชระเบียน') }}
                        </span>
                    </a>
                    <div class="collapse {{ (request()->is('tracking','store')) ? 'show' : '' }} {{ (request()->is('tracking/*','store/*')) ? 'show' : '' }}"
                        id="navbar-office">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('store')) ? 'active' : '' }} {{ (request()->is('store/*')) ? 'active' : '' }}"
                                    href="/store">
                                    {{ __('คลังเวชระเบียนผู้ป่วยใน') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('tracking')) ? 'active' : '' }} {{ (request()->is('tracking/*')) ? 'active' : '' }}"
                                    href="/tracking">
                                    {{ __('ติดตามเวชระเบียนผู้ป่วยใน') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    {{ __('ยืม/คืน เวชระเบียนผู้ป่วยใน') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            @if(Auth::user()->permission_id == 1)
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">เมนูผู้ดูแลระบบ</h6>
                <ul class="navbar-nav mb-md-3">
                    <li
                        class="nav-item {{ (request()->is('users')) ? 'active' : '' }}">
                        <a class="nav-link" href="/users">
                            <i class="fas fa-users text-info"></i> ระบบจัดการผู้ใช้งาน
                        </a>
                    </li>
                    <li
                        class="nav-item {{ (request()->is('token')) ? 'active' : '' }}">
                        <a class="nav-link" href="/token">
                            <i class="fab fa-line text-success"></i> กำหนด Line Token
                        </a>
                    </li>
                </ul>
            @endif
            <h6 class="navbar-heading text-muted">คู่มือการใช้งาน</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
