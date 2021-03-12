<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <a class="navbar-brand text-white" href="/">
            <img src="{{ asset('argon') }}/img/brand/logo.png" /> MDR :: WATCHAN HOSPITAL
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="{{ asset('argon') }}/img/brand/logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.watchanhospital.com">
                        <i class="ni ni-planet"></i>
                        <span class="nav-link-inner--text">{{ __('เว็บไซต์โรงพยาบาล') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="https://www.facebook.com/watchanhospital">
                        <i class="ni ni-like-2"></i>
                        <span class="nav-link-inner--text">{{ __('Facebook โรงพยาบาล') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="#">
                        <i class="ni ni-mobile-button"></i>
                        <span class="nav-link-inner--text">{{ __('ติดต่องานไอที') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>