<div style="margin-bottom: 1rem;">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">รายการติดตาม</h5>
                            <span class="h2 font-weight-bold mb-0 text-success">{{ $track_complete }}</span>
                            <span class="h2 font-weight-bold mb-0">/{{ $track_all }} <small class="text-light">รายการ</small></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-dark text-white rounded-circle shadow">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm text-center">
                        <span class="mr-2 badge badge-light btn-block"><i class="fas fa-clock"></i> รอดำเนินการ
                            {{ $track_all - $track_complete }} รายการ
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">เวชระเบียนทั้งหมด</h5>
                            <span class="h2 font-weight-bold mb-0 text-success">{{ $list_complete }}</span>
                            <span class="h2 font-weight-bold mb-0">/{{ $list_all }} <small class="text-light">รายการ</small></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-purple text-white rounded-circle shadow">
                                <i class="fas fa-clipboard"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm text-center">
                        <span class="mr-2 badge badge-light btn-block"><i class="fas fa-clock"></i> รอดำเนินการ
                            {{ $list_all - $list_complete }} รายการ
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">เวชระเบียนรอดำเนินการ</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $list_all - $list_complete }} <small class="text-light">รายการ</small></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm text-center">
                        @foreach($doctor as $dc)
                            <span class="badge badge-info">นัฐยา {{ $dc->nt }}</span>
                            <span class="badge badge-info">ประจินต์ {{ $dc->pj }}</span>
                            <span class="badge badge-info">ชาติชาย {{ $dc->cc }}</span>
                            <span class="badge badge-warning">อื่นๆ {{ $dc->ex }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">เวชระเบียนที่ส่งทันเวลา</h5>
                            <span class="h2 font-weight-bold mb-0">0</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm text-center">
                        <span class="badge badge-info">นัฐยา 0</span>
                        <span class="badge badge-info">ประจินต์ 0</span>
                        <span class="badge badge-info">ชาติชาย 0</span>
                        <span class="badge badge-warning">อื่นๆ 0</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
