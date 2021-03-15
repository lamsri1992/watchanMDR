<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
            href="{{ route('home') }}">{{ __('WATCHAN MDR :: ระบบบริหารจัดการเวชระเบียนผู้ป่วยใน โรงพยาบาลวัดจันทร์เฉลิมพระเกียรติ ๘๐ พรรษา') }}</a>
        <!-- User -->
        <form action="{{ url('/search') }}" method="POST" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input name="keyword" class="form-control" placeholder="ค้นหาเวชระเบียน [ ค้นจาก HN, VN ]" type="text">
                </div>
            </div>
        </form>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder"
                                src="{{ asset('argon') }}/img/theme/avatar.png">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ Auth::user()->permission }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fa fa-unlock-alt"></i>
                        <span>{{ __('เปลี่ยนรหัสผ่าน') }}</span>
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power"></i>
                        <span>{{ __('ออกจากระบบ') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
